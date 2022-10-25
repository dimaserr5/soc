<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Добавить пост
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="alert_block_secondary" style="display: none;" class="alert alert-secondary" role="alert"></div>
                <div id="alert_block_error" style="display: none;" class="alert alert-danger" role="alert"></div>
                <div id="alert_block_success" style="display: none;" class="alert alert-success" role="alert"></div>
                <div class="p-6 bg-white border-b border-gray-200 block_center_upload">
                        <div class="form-file form-file-sm">
                            <label class="input-file">
                                <input type="file" id="file" name="file">
                                <span>Выберите фото</span>
                            </label>
                        </div>
                        <div style="margin: 20px;">
                            <input type="text" name="desk" id="name_post" value="" placeholder="Введите описание">
                        </div>
                        <div style="margin: 20px;">
                            <button onclick="add_post();" id="add_post" style="color: white;" class="btn btn-custom-blue">Отправить</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.input-file input[type=file]').on('change', function(){
            let file = this.files[0];
            $(this).next().html(file.name);
        });
        function add_post() {
            var name_post = document.getElementById('name_post');
            var alert_block_error = document.getElementById('alert_block_error');
            var alert_block_secondary = document.getElementById('alert_block_secondary');
            var alert_block_success = document.getElementById('alert_block_success');
            var add_post = document.getElementById('add_post');

            alert_block_secondary.style.display = "block";
            alert_block_secondary.innerHTML = "Загрузка";
            add_post.disabled = true;

            var $input = $("#file");
            var fd = new FormData;
            fd.append('img', $input.prop('files')[0]);
            fd.append('name', name_post.value);


            $.ajax({
                url: "{{ route("postcreateadd") }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: fd,
                success: function(data){
                    add_post.disabled = false;
                    alert_block_secondary.style.display = "none";

                    if(data.status == "error") {
                        alert_block_error.style.display = "block";
                        alert_block_error.innerHTML = data.text;
                    }

                    if(data.status == "ok") {
                        alert_block_error.style.display = "none";
                        alert_block_success.style.display = "block";
                        alert_block_success.innerHTML = data.text;
                        setTimeout(function(){ window.location.reload()}, 2000);
                    }
                }
            });
        }
    </script>
</x-app-layout>

