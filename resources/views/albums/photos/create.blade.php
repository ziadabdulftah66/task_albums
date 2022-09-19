@extends('layouts.app')

@section('content')
    <a style="width: 200px; margin-left: 600px" href="{{route('albums.index')}}"
       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">All Albums</a>

    <div class="card-content collapse show">
        <div class="card-body">
            <form class="form" action="{{route('storeImages_DB')}}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$album->id}}" name="album_id">

                <div class="form-group">
                    <label>Album pictures </label>
                    <div style="margin-top: 50px">

                        <table style="background-color: whitesmoke">
                            <tr>
                                <!-- when add photo to album it show here -->
                                @isset($album->photos)
                                    @foreach($album->photos as $image)
                                        <td style="height: 100px;margin: auto">
                                            <img style="margin-right: 15px " height="150px" width="150px" src="{{$image->photo}}"><br>
                                            <a style="margin-right: 30px;margin-top: 9px;border-radius: 5px" href="{{route('DeleteImages',$image -> id)}}"
                                               class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">delete</a>
                                            <a style="margin-right: 30px;margin-top: 9px;border-radius: 5px" href="{{route('moveImages',$image -> id)}}"
                                               class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">move</a>
                                        </td>
                                    @endforeach
                                @endisset
                            </tr>
                        </table>
                    </div>
                </div>




<!-- add phot or more by dropzone -->
                <div class="form-group">
                    <div id="dpz-multiple-files" class="dropzone dropzone-area">
                        <div class="dz-message">You can upload more than one picture here
                        </div>

                    </div>

                    <br><br><br><br>
                </div>

                <div class="form-actions">

                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> save
                    </button>
                </div>

            </form>
        </div>
    </div>
    </div>
    </div>

    </div>
    </section>
    <!-- // Basic form layout section end -->
    </div>
    </div>
    @include('includes.alerts.success')
    @include('includes.alerts.errors')


@endsection
@section('script')

    <script>

        var uploadedDocumentMap={}

        Dropzone.options.dpzMultipleFiles= {
            paramName: "dzfile",
            maxFilesize: 5,
            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictFallbackMessage: "المتصفح الخاص بكم لا يدعم السحب",
            dictInvalidFileType: 'لا يمكن رفع هذا النوع من الملفات',
            dictCancelUpload: "الغاء الرفع",
            dictCancelUploadConfirmation: "هل انت متاكد من الالغاء",
            dictRemoveFile: "حذف الصوره",
            dictMaxFilesExceeded: "لا يمكنك رفع اكثر من 5",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"

            },
            url: "{{route('storeImages')}}",
            success: function (file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name


            },
            removedfile: function (file) {
                file.previewElement.remove();
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            }
            ,
            init: function () {
                @if(isset($event) && $event->document)
                var files =
                    {!! json_encode($event->document) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }



    </script>
@stop
