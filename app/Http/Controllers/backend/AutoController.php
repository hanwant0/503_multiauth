<?php

    namespace App\Http\Controllers\backend;

    use App\Model\backend\Automanufacturer;
    use App\Model\backend\Auto;
    use App\Model\backend\Tag;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\Facades\Session;
    use Yajra\Datatables\Facades\Datatables;
    use Validator;
    use Illuminate\Support\Facades\DB;
    use Symfony\Component\HttpFoundation\File\File;

    class AutoController extends Controller
    {

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            
        }

        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $data = array(
                'page_title' => 'List Auto'
            );
            return view('backend.auto.index')->with($data);
        }

        public function create()
        {
            $arr_automanufacturer = Automanufacturer::orderBy('automanufacturer_title')->pluck('automanufacturer_title', 'automanufacturer_id');
            $arr_year = \Config::get('custom.year');


            $data = array(
                'page_title' => 'Create Auto',
                'arr_automanufacturer' => $arr_automanufacturer,
                'arr_year' => $arr_year
            );


            return view('backend.auto.create')->with($data);
        }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                    'automanufacturer_id' => 'required|integer|exists:automanufacturers,automanufacturer_id',
                    'auto_model' => 'required|min:3|max:100',
                    'auto_model_year' => 'required',
                    'auto_asking_price' => 'required|numeric|min:1000|max:9999999999',
                    'auto_mileage' => 'required|numeric|max:999.99',
                    'auto_image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);
            if ($validator->fails())
            {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
            else
            {
                $tag_ids = Tag::createAndReturnArrayOfTagIds($request->tags);
                $upload = Auto::upload($request->file('auto_image'));

                $auto = New Auto;
                $auto->automanufacturer_id = $request->automanufacturer_id;
                $auto->auto_model = $request->auto_model;
                $auto->auto_model_year = $request->auto_model_year;
                $auto->auto_asking_price = $request->auto_asking_price;
                $auto->auto_mileage = $request->auto_mileage;
                $auto->auto_image = $upload['filename'];
                $auto->save();
                //Now attach the tags, since this is creating method, attach() is okay
                $auto->tags()->attach($tag_ids);

                return redirect('admin/auto')->withSuccess('Auto saved successfully!');
            }
        }

        public function show($id)
        {
            
        }

        public function edit($id)
        {
            $auto = Auto::with('automanufacturer', 'tags')->find($id);
            if (!$auto)
            {
                return redirect('admin/auto')
                        ->withError('Auto not found!');
            }

            $arr_automanufacturer = Automanufacturer::orderBy('automanufacturer_title')->pluck('automanufacturer_title', 'automanufacturer_id');
            $arr_year = \Config::get('custom.year');


            $data = array(
                'page_title' => 'Edit Auto',
                'arr_automanufacturer' => $arr_automanufacturer,
                'arr_year' => $arr_year,
                'auto' => $auto
            );

            return view('backend.auto.edit')
                    ->with($data);
        }

        public function update(Request $request, $id)
        {

            $auto = Auto::find($id);

            if (!$auto)
            {
                return redirect('/admin/auto/')
                        ->withError('Auto not found!');
            }

            $validatior = Validator::make($request->all(), [
                    'automanufacturer_id' => 'required|integer|exists:automanufacturers,automanufacturer_id',
                    'auto_model' => 'required|min:3|max:100',
                    'auto_model_year' => 'required',
                    'auto_asking_price' => 'required|numeric|min:1000|max:9999999999',
                    'auto_mileage' => 'required|numeric|max:999.99',
                    'auto_image' => 'image|mimes:jpeg,png,jpg|max:1024',
            ]);

            if ($validatior->fails())
            {
                return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validatior);
            }
            else
            {
                $isFileUploaded = $request->hasFile('auto_image');
                $tag_ids = Tag::createAndReturnArrayOfTagIds($request->get('tags'));

                if ($isFileUploaded)
                {
                    $path_to_image = public_path('uploads/auto/') . $auto->auto_image;
                    \File::delete($path_to_image);

                    $upload = Auto::upload($request->file('auto_image'));
                    $auto->auto_image = $upload['filename'];
                }

                $auto->automanufacturer_id = $request->automanufacturer_id;
                $auto->auto_model = $request->auto_model;
                $auto->auto_model_year = $request->auto_model_year;
                $auto->auto_asking_price = $request->auto_asking_price;
                $auto->auto_mileage = $request->auto_mileage;
                $auto->save();
                $auto->tags()->sync($tag_ids);

                return redirect('admin/auto')->withSuccess('Auto updated successfully!');
            }
        }

        public function add($id = NULL)
        {
            $data = array();
            if (!empty($id))
            {
                $auto = Auto::find($id);
                if (!$auto)
                {
                    return redirect('admin/auto')
                            ->withError('Auto not found!');
                }
                $data ['page_title'] = 'Edit Auto';
                $data['save_url'] = url('admin/auto/save/' . $auto->auto_id);
                $data['submit_button'] = 'Update';
                $data['auto'] = $auto;
            }
            else
            {
                $data ['page_title'] = 'Create Auto';
                $data['save_url'] = url('admin/auto/save');
                $data['submit_button'] = 'Save';
            }
            $arr_automanufacturer = Automanufacturer::orderBy('automanufacturer_title')->pluck('automanufacturer_title', 'automanufacturer_id');
            $arr_year = \Config::get('custom.year');

            $data['arr_automanufacturer'] = $arr_automanufacturer;
            $data['arr_year'] = $arr_year;

            return view('backend.auto.add')->with($data);
        }

        public function save(Request $request, $id = NULL)
        {
            if (!empty($id))
            {
                $auto = Auto::find($id);

                if (!$auto)
                {
                    return redirect('/admin/auto/')->withError('Auto not found!');
                }
                $auto_image_required = '';
                $success_msg = 'Auto updated successfully!';
            }
            else
            {
                $auto = New Auto;
                $auto_image_required = 'required|';
                $success_msg = 'Auto saved successfully!';
            }



            $validatior = Validator::make($request->all(), [
                    'automanufacturer_id' => 'required|integer|exists:automanufacturers,automanufacturer_id',
                    'auto_model' => 'required|min:3|max:100',
                    'auto_model_year' => 'required',
                    'auto_asking_price' => 'required|numeric|min:1000|max:9999999999',
                    'auto_mileage' => 'required|numeric|max:999.99',
                    'auto_image' => $auto_image_required . 'image|mimes:jpeg,png,jpg|max:1024',
            ]);

            if ($validatior->fails())
            {
                return redirect()->back()->withInput()->withErrors($validatior);
            }
            else
            {
                $isFileUploaded = $request->hasFile('auto_image');
                $tag_ids = Tag::createAndReturnArrayOfTagIds($request->get('tags'));

                if ($isFileUploaded)
                {
                    if (!empty($id))
                    {
                        $path_to_image = public_path('uploads/auto/') . $auto->auto_image;
                        \File::delete($path_to_image);
                    }
                    $upload = Auto::upload($request->file('auto_image'));
                    $auto->auto_image = $upload['filename'];
                }

                $auto->automanufacturer_id = $request->automanufacturer_id;
                $auto->auto_model = $request->auto_model;
                $auto->auto_model_year = $request->auto_model_year;
                $auto->auto_asking_price = $request->auto_asking_price;
                $auto->auto_mileage = $request->auto_mileage;
                $auto->save();

                if (!empty($id))
                {
                    $auto->tags()->sync($tag_ids);
                }
                else
                {
                    $auto->tags()->attach($tag_ids);
                }

                return redirect('admin/auto')->withSuccess('Auto updated successfully!');
            }
        }

        public function destroy($id)
        {

            $auto = Auto::find($id);
            if ($auto)
            {
                $path_to_image = public_path('uploads/auto/') . $auto->auto_image;

                \File::delete($path_to_image);
                $auto->delete();

                $return_arr = array(
                    'status' => 'success',
                    'message' => 'Auto deleted successfully!'
                );
            }
            else
            {
                $return_arr = array(
                    'status' => 'error',
                    'message' => 'Auto not found!'
                );
            }
            echo json_encode($return_arr);
        }

        public function anyData()
        {
            $autos = Auto::with('automanufacturer')->select('autos.*');
            return Datatables::of($autos)
                    ->addColumn('action', function ($auto)
                    {
                        return '<a href="auto/add/' . $auto->auto_id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'
                            . ' <a href="auto/' . $auto->auto_id . '/delete" id="' . $auto->auto_id . '" class="btn btn-xs btn-primary delete-button"><i class="glyphicon glyphicon-remove"></i>Delete</a>';
                    })
                    ->editColumn('auto_id', 'ID: {{$auto_id}}')
                    ->make(true);
        }

    }
    