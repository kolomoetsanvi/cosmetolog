@if(isset($cosmetolog->id) && count($works)> 0)

    <div >
        <table class="table-bordered table-striped " style="width: 100% " callspacing="0" cellpadding="10">
            <thead>
            <th>Фото</th>
            <th>Пометка</br>на удаление</th>
            </thead>
            <tbody>

                @foreach($works as $work)
                    <tr>
                        <td>
                            <img style="max-height: 120px" src="{{ asset("storage/".$work) }}" />
                        </td>
                        <td class="chBCellWorks">
                            <input name="worksCheckDelete[]" type="checkbox" value="{{$work}}" id="1">
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
                @for($j = 0; $j < $newWorksCount; $j++)
                    <li class="text-field">
                        <div class="input-prepend">
                            <input type="file" class="filestyle data-buttonText" name="imageWorks[]" value="Выберите файл">
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
</div>
