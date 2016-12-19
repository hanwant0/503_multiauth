<?php

    namespace App\Http\Controllers\backend;

    use App\Model\backend\Automanufacturer;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\Facades\Session;
    use Yajra\Datatables\Facades\Datatables;
    use Validator;
    use Illuminate\Support\Facades\DB;

    class AutomanufacturerController extends Controller
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
                'page_title' => 'List Automanufacturer'
            );
            return view('backend.automanufacturer.index')->with($data);
        }

        public function create()
        {
            $data = array(
                'page_title' => 'Create Automanufacturer'
            );

            return view('backend.automanufacturer.create')->with($data);
        }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                    'title' => 'required|unique:automanufacturers|min:3|max:50',
            ]);
            if ($validator->fails())
            {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
            else
            {
                $automanufacturer = New Automanufacturer;
                $automanufacturer->title = $request->title;
                $automanufacturer->save();
                return redirect('admin/automanufacturer')->withSuccess('Automanufacturer saved successfully!');
            }
        }

        public function show($id)
        {
            
        }

        public function edit($id)
        {
            $automanufacturer = Automanufacturer::find($id);


            if (!$automanufacturer)
            {
                return redirect('admin/automanufacturer')
                        ->withError('Automanufacturer not found!');
            }

            $data = array(
                'page_title' => 'Edit Automanufacturer',
                'automanufacturer' => $automanufacturer
            );

            return view('backend.automanufacturer.edit')
                    ->with($data);
        }

        public function update(Request $request, $id)
        {
            $automanufacturer = Automanufacturer::find($id);

            if (!$automanufacturer)
            {
                return redirect('/admin/automanufacturer')
                        ->withError('User not found!');
            }

            $validatior = Validator::make($request->all(), [
                    'title' => 'required|min:3|max:50|unique:automanufacturers,title,' . $id . ',automanufacturer_id'
            ]);

            if ($validatior->fails())
            {
                return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validatior);
            }
            $automanufacturer->title = $request->title;
            $automanufacturer->save();

            return redirect('admin/automanufacturer')->withSuccess('Automanufacturer updated successfully!');
        }

        public function destroy($id)
        {
            Automanufacturer::find($id)->delete();
            echo json_encode(TRUE);
        }

        public function anyData()
        {

            $automanufacturers = DB::table('automanufacturers')
                ->select(['automanufacturer_id', 'title', 'created_at', 'updated_at']);

            return Datatables::of($automanufacturers)
                    ->addColumn('action', function ($automanufacturer)
                    {
                        return '<a href="automanufacturer/' . $automanufacturer->automanufacturer_id . '/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>'
                            . ' <a href="automanufacturer/' . $automanufacturer->automanufacturer_id . '/delete" id="' . $automanufacturer->automanufacturer_id . '" class="btn btn-xs btn-primary delete-button"><i class="glyphicon glyphicon-remove"></i>Delete</a>';
                    })
                    ->editColumn('automanufacturer_id', 'ID: {{$automanufacturer_id}}')
                    ->make(true);
        }

    }
    