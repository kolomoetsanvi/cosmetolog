// Модальное окно 

function modalWindow(){
	
//document.write('<div class="modal bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="...">');
document.write('<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">');
  document.write('<div class="modal-dialog modal-sm" role="document">');
    document.write('<div class="modal-content">');
        document.write('<div class="modal-body">');
			document.write('<p id="modalTxt" style="font-size: 12pt; font-weight: bold;" />');
      document.write('</div>');
      document.write('<div class="modal-footer">');
        document.write('<button type="button" class="btn btn-primary" data-dismiss="modal" id="closeBtn">Ok</button>');
      document.write('</div>');
    document.write('</div>');
  document.write('</div>');
document.write('</div>');


	$('#closeBtn').on('click', 	function(){
					location.reload();
					});    

}// modalWindow()


// Данное окно не перегружает страницу
function modalWindowNonReload(){

//document.write('<div class="modal bs-example-modal-sm" id="myModalNonReload" tabindex="-1" role="dialog" aria-labelledby="...">');
document.write('<div class="modal fade bd-example-modal-lg" id="myModalNonReload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">');
  document.write('<div class="modal-dialog modal-lg" role="document">');
    document.write('<div class="modal-content">');
        document.write('<div class="modal-body">');
			document.write('<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af842a42b9c19bf377032e6d9194d360b40305aee7d7f897c68269e3290d81a7b&amp;width=720&amp;height=480&amp;lang=ru_RU&amp;scroll=true"></script>');
      document.write('</div>');
      document.write('<div class="modal-footer">');
        document.write('<button type="button" class="btn btn-primary" data-dismiss="modal" id="closeBtn">Ok</button>');
      document.write('</div>');
    document.write('</div>');
  document.write('</div>');
document.write('</div>');

}// modalWindowNonReload(){


























































						
