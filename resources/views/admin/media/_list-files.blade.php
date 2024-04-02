

<div class="row">
	<div class="col text-right">
		<h5>Total: {{@$files->count()}}</h5>
	</div>
</div>
<ul>
@foreach($files as $file)

								<li class="">
									@if(in_array(strtolower($file->type),['jpg','png','gif','tif','svg','webp','jpeg']))
									<a href="" data-toggle="tooltip" data-placement="bottom" title="{{$file->file}}"><img src="{{asset($file->folder_parent.$file->folder.$file->file)}}" alt="">
								</a>
<small class="nome">{{$file->file}}</small>
									@else
									<a href="" style="width: 130px; height: 85px;" data-toggle="tooltip" data-placement="bottom" title="{{$file->file}}">
										<i class="fa fa-file fa-4x"></i>
									</a>
<small class="nome">{{$file->file}}</small>
									@endif
									<hr class="m-all-xs">
									<div class="row">
									<div class="col-sm-4 text-left"><input type="checkbox" name="file[]"  class="checkFile"  value="{{$file->id}}"></div>
									<div class="col-sm-8  text-right pull-right col-sm-8 d-flex gap-1 justify-content-end pull-right text-right">
										<button class="btn btn-danger btn-sm btn-icon-only  removeImg" style="position: relative;overflow: hidden;display: flex;align-items: center;justify-content: center;" data-id="{{$file->id}}">
											<i class="fa fa-trash"></i>
										</button>
									<button type="button" class="btn btn-primary btn-sm btn-icon-only btCopyLink" style="position: relative;overflow: hidden;display: flex;align-items: center;justify-content: center;" onclick="copyToClipboard('#copy_{{$file->id}}')">
										<i class="fa fa-link"></i>
										<input type="text" id="copy_{{$file->id}}" style="position: absolute; left: -99999em; opacity: 0;" value="{{asset($file->folder_parent.$file->folder.$file->file)}}">
									</button>
									</div>
									</div>
								</li>
								@endforeach
								</ul>