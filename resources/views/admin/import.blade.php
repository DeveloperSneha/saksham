@extends('admin.admin_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Companies List : <span class="font-semibold"></span></div>
    <div class="panel-body">
        <div class="import_export_admin">
            <div class="import_export_admin_container">
                <div class="admin_import">
                    <h1>Import Saksham Darpan Data</h1>


                    <form method="post" enctype="multipart/form-data" action="/admin/import/">
                        <div class="form-group">
                            <div class="file-upload">
                                <label for="darpan_data_file" class="file-upload__label">File Upload</label>
                                <input type="file" name="file" class="form-control" id="darpan_data_file">
                            </div>

                            <label for="darpan_data_type">Which data you want to import ?</label>
                            <select name="darpan_import_type" class="form-control" id="darpan_import_type">

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="admin_export">
                    <h1>Export Saksham Darpan Data</h1>
                    <ul class="export_files">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop