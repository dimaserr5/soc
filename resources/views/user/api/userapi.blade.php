<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Api
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php if(!$api_keys) : ?>
                        <div><span>У вас нет активных API Ключей</span></div>
                        <div class="block_profile_api">
                            <button type="button" class="btn btn-primary btn-custom-blue" data-bs-toggle="modal" data-bs-target="#add_api_key">
                                Добавить API ключ
                            </button>
                        </div>
                    <?php else: ?>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Название ключа</th>
                                <th scope="col">API Key</th>
                                <th scope="col">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($api_keys as $key) : ?>
                            <tr>
                                <th style="vertical-align: middle;" scope="row"><span>{{ $key['name'] }}</span></th>
                                <td style="vertical-align: middle;">{{ $key['api_key'] }}</td>
                                <td style="vertical-align: middle;"><a class="btn">Удалить</a></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="block_profile_api">
                            <button type="button" class="btn btn-primary btn-custom-blue" data-bs-toggle="modal" data-bs-target="#add_api_key">
                                Добавить API ключ
                            </button>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <!-- Модальное окно -->
    <div class="modal fade" id="add_api_key" tabindex="-1" aria-labelledby="add_api_key_lable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_api_key_lable">Мастер создания нового API Ключа</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <div id="alert_block_error" style="display: none;" class="alert alert-danger" role="alert"></div>
                    <div id="alert_block_success" style="display: none;" class="alert alert-success" role="alert"></div>
                    <div class="form-control-block">
                        <label for="api_name" class="form-label">Название ключа</label>
                        <input type="text" class="form-control-custom" id="api_name">
                    </div>
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-custom-mi_black" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary btn-custom-blue" onclick="add_api();">Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function add_api() {
            var api_name = document.getElementById('api_name');
            var alert_block_error = document.getElementById('alert_block_error');
            var alert_block_success = document.getElementById('alert_block_success');
            if(api_name.value) {
                $.ajax({
                    url: "{{ route("userapiadd") }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    dataType: 'json',
                    data: {name: api_name.value},
                    success: function(data){
                        if(data.status == "ok") {
                            alert_block_error.style.display = "none";
                            alert_block_success.style.display = "block";
                            alert_block_success.innerHTML = data.text;
                            setTimeout(function(){ window.location.reload()}, 2000);
                        }

                        if(data.status == "error") {
                            alert_block_error.style.display = "block";
                            alert_block_error.innerHTML = data.text;
                        }
                    }
                });
            }else {
                alert_block_error.style.display = "block";
                alert_block_error.innerHTML = 'Ошибка, введите имя ключа';
            }
        }
    </script>
</x-app-layout>
