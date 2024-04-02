<div>
    
    <div class="wrapper-upload" >
  
    <div>
        <button type="button" class="btn btn-primary btn-block openPopUpMedia" data-target="{{$target}}" data-collum="{{$collum}}">
            <i class="fa fa-cloud-upload" aria-hidden="true"></i> Selecionar Imagem
        </button>
        </div>
    <div class="preview" >

            @if(@$media->media)
             
                    <input type="hidden" name="{{$collum}}" value="" />
                    <a href="#" class="remove" data-file="{{ @$media->media->id }}">
                        <i class="fas fa-times"></i>
                    </a>
                    <img src="{{ @$media->media->fullpatch() }}" alt=""><Br>
                 
               
            @else
            <input type="hidden" name="{{$collum}}" value="" />
            @endif
      
    </div>
    </div>
    <div class="modal fade" id="modalMedia" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="padding: 10px;" >
            <div id="contentMedia"></div>
            <div class="clearfix"></div>
        </div>
        </div>
        </div>
        </div>

    @push('assets')
    <style>
        .preview {
            position: relative;
            display: inline-block;
        }
                .preview img {
            height: 100px;
            border: 1px solid;
            /* padding: 2px; */
            border-radius: 5px;
            box-shadow: 0 0 8px #ededed;
        }
        .preview .remove {
            position: absolute;
            right: 0;
            top: 0;
            background: red;
            border-radius: 0px 5px 0px 5px;
            padding: 2px 6px;
            color: #fff;
        }
    </style>
    @endpush
    @push('scripts')
<script>
      $("body").on('click',".openPopUpMedia",function(e){
      e.preventDefault();
        $(this).closest('.wrapper-upload').addClass('target-active');
      var target = $(this).data('target');
      var collum = $(this).data('collum');
     
      openPopUpMedia(target,collum)
    })
      $("body").on('click',".remove",function(e){
      e.preventDefault();
       // $(this).closest('.preview').find('img').remove();
        var $input = $(this).closest('.preview').find('input[type="hidden"]');
        $(this).closest('.preview').html($input.val(''))
    })

    function openPopUpMedia(target,collum){
     
        if(target){
            localStorage.setItem("media_target", target);
        }
        if(collum){
            localStorage.setItem("media_collum", collum);
        }
        if($("#contentMedia").html() == ""){
        $.get('{{route("admin.media.popUp")}}',function(data){
            $("#contentMedia").html(data);
            $('#modalMedia').modal('show');
            $("#contentMedia").find('.checkFile').prop('checked',false);

        })
        }else{
        $('#modalMedia').modal('show')
        //$("#modalMedia .content").removeClass('hidden')
        $("#contentMedia").find('.checkFile').prop('checked',false);

        }
        }
</script>

@endpush