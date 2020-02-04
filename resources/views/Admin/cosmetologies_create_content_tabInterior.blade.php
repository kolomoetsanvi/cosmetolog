@if(isset($cosmetolog->id) && count($interiors)> 0)

    <div >
        <table class="table-bordered table-striped " style="width: 100% " callspacing="0" cellpadding="10">
            <thead>
            <th>Фото</th>
            <th>Пометка</br>на удаление</th>
            </thead>
            <tbody>

            @foreach($interiors as $interior)
                <tr>
                    <td>
                        <img style="max-height: 120px" src="{{ asset("storage/".$interior) }}" />
                    </td>
                    <td class="chBCellInteriors">
                        <input name="interiorsCheckDelete[]" type="checkbox" value="{{$interior}}" >
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>


    @endif

    </br> </br>

    <div class="row">
        <div class="col-md-8 offset-2">
            <ul style=" list-style-type: none">
                @for($j = 0; $j < $newInteriorsCount; $j++)
                    <li class="text-field">
                        <div class="input-prepend">
                            <input type="file" class="filestyle data-buttonText" name="imageInteriors[]" value="Выберите файл">
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </div>

