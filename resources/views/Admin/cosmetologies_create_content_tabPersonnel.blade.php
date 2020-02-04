@if(isset($cosmetolog->id))

    <div >
        @if(!$cosmetolog->cosmetologiesPersonnel->isEmpty())
            <table class="table-bordered table-striped " style="width: 100% " callspacing="0" cellpadding="10">
                <thead>
                <th>Фото</th>
                <th>ФИО</th>
                <th>Пометка</br>на удаление</th>
                <th>Новый сотрудник, </br> (не обязательно)</th>
                </thead>
                <tbody>

                @foreach($cosmetolog->cosmetologiesPersonnel as $person)
                    <tr>
                        <td>
                            <img style="max-height: 120px" src={{ asset("storage/assets/img/personnel/".$person->id."/personnel.jpg") }}  />
                        </td>
                        <td>
                            {{ $person->surname}}
                            &nbsp {{ $person->name}}
                            &nbsp{{ $person->patronymic}}
                        <td class="chBCell">
                            <input name="cosmetologPersonnelCheck[]" type="checkbox" value="{{$person->id}}" id="{{$person->id}}">
                        </td>
                        <td >
                            <select class="form-control" name="selectedPersonnel[]" size="1" id="select{{$person->id}}" style="visibility: visible" >
                                <option value="-1">------</option>
                                @foreach($personnel as $item)
                                    @if($person->id == $item->id )
                                        <option selected="selected" value="{{$item->id}}">
                                            {{$item->surname}} &nbsp {{$item->name}} &nbsp {{$item->patronymic}}
                                        </option>
                                    @else
                                        <option value="{{$item->id}}">
                                            {{$item->surname}} &nbsp {{$item->name}} &nbsp {{$item->patronymic}}
                                        </option>
                                    @endif

                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        @endif
    </div>

    <script>
        $(document).ready(function() {
           //
            $(function(){
                $('input', ".chBCell").on('click', function(e){
                    //num - id чекбокса
                    num = Number.parseInt($(this).attr('id'));
                    //если чекбокс установлен на удаление сотрудника
                    // скрываем селект с выбором сотрудников
                    //устанавливаем значение данного селект в -1
                    if ($(this).is(':checked')){
                        $("#select"+num).css({'visibility':'hidden'});
                        $("#select"+num).val(-1);
                    // если чек бокс не установлен
                    // селект отображается со списком всех  возможных сотрудников из БД
                    // с установленным сотрудни ком с фото
                    } else {
                        $("#select"+num).css({'visibility':'visible'});
                        $("#select"+num).val(num);
                    }

                });
            });
        });
    </script>

@endif

</br> </br>

    <div class="row">
         <div class="col-md-12">
            @for($j = 0; $j < $newPersonnelCount; $j++)
                <ul style=" list-style-type: none">
                     <li class="text-field">
                         <div class="row">
                             <div class="input-prepend col-md-6">
                                <select class="form-control" name="selectedPersonnel[]" size="1" >
                                    <option value="-1">------</option>
                                    @foreach($personnel as $person)
                                          <option value="{{$person->id}}">
                                              {{$person->surname}} &nbsp {{$person->name}} &nbsp {{$person->patronymic}}
                                          </option>
                                    @endforeach
                                </select>
                             </div>
                         </div>
                         <div class="input-prepend col-md-6">
                         </div>
                    </li>
                    </br>
                </ul>
            @endfor
         </div>
    </div>

