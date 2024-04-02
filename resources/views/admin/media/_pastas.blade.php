	<ul class="list-group">
				<li class="list-group-item"><a href="" data-folder="{{$folderAtual}}"><i class="fa fa-folder"></i> {{$folderAtual}}</a><a href=""  class="newFolter" data-folder="{{$folderAtual}}"><i class="fas fa-folder-plus" data-toggle="tooltip" data-placement="top" title="Nova pasta"></i>
					</a>
				<div class="box-newFolder">
						<form action="{{route('admin.media.newFolder')}}"  method="post" class="formNewFolder">
							@csrf
							<input type="hidden" name="folder_pai" value="{{$folderAtual}}" />
							 <div class="form-row align-items-center">
							 	<div class="col-auto">
								<input type="text" name="name_folder" required class="form-control  form-control-sm">
							</div>
							 	<div class="col-auto">
								<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-paper-plane"></i></button>
								</div>
								<div class="col-auto">
								<button type="button" class="btn btn-sm btn-danger cancelNew"><i class="fas fa-times"></i></button>
								</div>
								</div>
						</form>
							</div>
						</li>
				@foreach(@$folders as $folder)
					<li class="list-group-item">|- <a href=""  data-folder="{{$folder}}"><i class="fa fa-folder"></i> {{$folder}}</a>
				</li>
				@endforeach
			</ul>
