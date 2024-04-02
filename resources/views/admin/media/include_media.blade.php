@section('pre-assets')
<style>
	.list-files {
		list-style: none;
		margin: 0;
		padding: 0;
	}
	.list-files li {
		display: inline-block;
		vertical-align: top;
		text-align: center;
		border: 1px solid #ededed;
		padding: 5px;
		border-radius: 4px;
		margin-bottom: 5px;
		width: 24%;
		min-width: 140px;
	}
	li.active a {
		color: #fff;
	}
	.list-files li img {
		width: auto%;
		height: auto;
		max-height: 85px;
	}
	.list-files li:hover {
		background: #ededed;
		transition: 0.2s all linear;
	}
	.list-files li a {
		display: block;
		height: 85px;
		overflow: hidden;
		line-height: 85px;
		vertical-align: middle;
		margin: 0 auto;
		color: #666;
		background: #b2b2b2;
	}
	.newFolter {
		float: right;
		position: relative;
	}
	.box-newFolder {
		display: none;
		z-index: 100;
	}
	.container-upload {
    background: rgba(17, 74, 153, .26);
    border: 1px solid #114a99;
    margin-bottom: 20px;
    text-align: center;
    font-size: 1.5em;
    position: relative;
    padding: 5px
}

.container-upload input.uploadArquivos{
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    z-index: 1;
    cursor: pointer
}
</style>
<!-- /.col -->
<section class="content-header m-bottom-md">
	<h5 class="modal-title float-left">Media Manager</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
	<div class="clearfix"></div>
</section>
<div class="content row">

	<div class="col-12 pull-right">
		<div class="card card-default">
			
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							
							<div class="container-upload m-0">
								
								<div class="carregandoForm" style="display: none"><i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span></div>
								<input type="file" id="uploadArquivos" class="uploadArquivos" multiple="" name="file">
								<div><i class="fa fa-cloud-upload" aria-hidden="true"></i> UPLOAD FILE</div>
							</div>
						</div>
						<div class="alert alert-success p-all-xs" role="alert" style="display: none"></div>
					</div>
				<div class="col-6">
					<input placeholder="Pesquisar" onkeyup="searchUser('listArquivos','filterlistFiles')" id="filterlistFiles" class="form-control ">
					</div>
				</div>
				<hr>
				<div class="row" style="max-height: 280px;overflow: auto;">
					<form action="" id="formFiles">
						@csrf
						<input type="hidden" name="folder" value="{{$folderAtual}}">
						<input type="hidden" name="folder_parent" value="{{$folder_parent}}">
						<div class="col-12">
							<ul class="list-files" id="listArquivos">
							</ul>
						</div>
					</form>
				</div>
				<div class="row  m-top-xs " id="row">
					<div class="col">
						<input type="checkbox" name="checkAll" id=""> Marcar todos
					</div>
					<!--
					<div class="col-12 pull-right text-center">
						<a href="" class="btn btn-danger btn-sm actionRemove">Remover</a>
						<a href="" class="btn btn-primary btn-sm usarImage" data-alvo="destaque">Usar Imagem em Destaque</a>
						<a href="" class="btn btn-primary btn-sm usarImage" data-alvo="galeria">Usar Imagem em Galeria de fotos</a>
					</div>
					-->
				</div>
				<div class="row">
					<div class="cols-m-12 text-center">
						{{$files}}
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-danger actionRemove">Remover</a>
				<a href="" class="btn btn-primary  usarImage">Inserir</a>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script type="text/javascript">
	function searchUser(id, input) {
		// Declare variables
		var input, filter, ul, li, a, i, txtValue;
		input = document.getElementById(input);
		filter = input.value.toUpperCase();
		ul = document.getElementById(id);
		li = ul.getElementsByTagName('li');
		// Loop through all list items, and hide those who don't match the search query
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByClassName("nome")[0];
			txtValue = a.textContent || a.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	}
	$("body").on('click', '.newFolter', function(e) {
		e.preventDefault();
		$(".box-newFolder").fadeIn('fast');
	})
	$("body").on('click', '.cancelNewFolder', function(e) {
		e.preventDefault();
		$(".box-newFolder").fadeOut('fast');
	})
	$("body").on('submit', '.formNewFolder', function(e) {
		e.preventDefault();
		var url = $(this).attr('action'); // the script where you handle the form input.
		$.ajax({
			type: "POST",
			url: url,
			data: $(this).serialize(), // serializes the form's elements.
			success: function(data) {
				$("#list-pastas").html(data);
			}
		});
		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	var ajaxLoading = false;
	function copyToClipboard(element) {
		$(element).select();
		document.execCommand("copy");
		$(".alert-success").html('Link Copiado').fadeIn('fast').delay(2000).fadeOut('fast', function() {
			$('#modalMedia').modal('hide');
		})
	}
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
		function listFiles(folder, page = 1) {
			if (!folder) {
				folder = 'uploads/';
			} else {}
			var data = new FormData();
			data.append('folder', folder);
			data.append('_token', '{{ csrf_token() }}');
			data.append('page', page);
			$.ajax({
				url: '{{route("admin.media.list-files")}}',
				type: 'POST',
				cache: false,
				contentType: false,
				processData: false,
				data: data,
				success: function(result) {
					$(".list-files").html(result)
				}
			});
		}
		listFiles();
		$(".list-files").on('click', 'a', function(e) {
			e.preventDefault();
		});
		$("body").on('click', '.actionRemove', function(e) {
			e.preventDefault();
			$.post('{{route("admin.media.delete-media")}}', $("#formFiles").serialize(), function(data) {
				//console.log(data);
				//var href = $('.pagination .active a').attr('href');
				//var page = $('.pagination .active a').attr('href').split("=");
				listFiles($("input[name='folder']").val());
			})
		})
		$("body").on('click', '.removeImg', function(e) {
			e.preventDefault();
			$.post('{{route("admin.media.delete-media")}}', $("#formFiles").serialize(), function(data) {
				//console.log(data);
				//var href = $('.pagination .active a').attr('href');
				//var page = $('.pagination .active a').attr('href').split("=");
				listFiles($("input[name='folder']").val());
			})
		})
		$("body").on('click', '.usarImage', function(e) {
			e.preventDefault();
			var count = $('input[name="file[]"]:checked').length;
			var val = $('.list-files input[name="file[]"]:checked').val();
			var preview = $('.target-active').find('.preview');
			var collum = localStorage.getItem("media_collum");
			var alvo = localStorage.getItem("media_target");
		
		
				$.get('{{route("admin.media.getFile")}}/' + val, function(data) {
					var html = '';
					html += '<input type="hidden" name="'+collum+'" value="' + data.id + '" />';
					html += '<a href="#" class="remove" data-file="' + data.arquivo + '">';
					html += '<i class="fas fa-times"></i> ';
					html += '</a>';
					html += '<img src="' + data.fullpatch + '">';
					
					$(preview).html(html);
					$('#modalMedia').modal('hide');
					$(".target-active").removeClass('target-active')
				});
			
			
			
			
			
			
			
		})
		$("body").on('click', '.checkFile', function(e) {
			if ($('.checkFile:checked').length > 0) {
				//$(".actionRemove").closest('.row').removeClass("hidden");
			} else {
				//$(".actionRemove").closest('.row').addClass("hidden");
			}
		})
		$("body").on('click', ".list-group a", function(e) {
			e.preventDefault();
			var folder = $(this).data('folder');
			$("#list-pastas li").removeClass('active');
			$(this).closest('li').addClass('active')
			$("input[name='folder']").val(folder)
			listFiles(folder);
		})
		$(".pagination li").eq(1).html('<a class="page-link" href="{{route("admin.media.index")}}?page=1">1</a>');
		$(".page-link").click(function(e) {
			e.preventDefault();
			var page = $(this).attr('href').split("=");
			$(".pagination").find(".active").removeClass("active");
			$(this).parent().addClass("active")
			listFiles($("input[name='folder']").val(), page[1]);
		})
		$('body').on('change', '#uploadArquivos', function() {
			$(this).siblings('.carregandoForm').fadeIn('fast');
			$("#carregandoForm").show(0);
			var data = new FormData();
			$.each($(this)[0].files, function(i, file) {
				data.append('file[]', file);
			});
			data.append('folder', $("input[name='folder']").val());
			data.append('folder_parent', $("input[name='folder_parent']").val());
			data.append('_token', '{{ csrf_token() }}');
			if (!ajaxLoading) {
				ajaxLoading = true;
				$.ajax({
					url: '{{route("admin.media.upload-media")}}',
					type: 'POST',
					cache: false,
					contentType: false,
					processData: false,
					data: data,
					success: function(result) {
						console.log(result);
						$('.carregandoForm:visible').fadeOut('fast');
						listFiles($("input[name='folder']").val());
						ajaxLoading = false;
					}
				});
			}
		});
	});
	$("body").on('click', "input[name='checkAll']",function(){
		$(".checkFile").click()
	});
</script>