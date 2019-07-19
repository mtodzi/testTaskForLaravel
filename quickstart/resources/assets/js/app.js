
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./bootstrap-datepicker.min');
require('./bootstrap-datepicker.ru.min');
require('./js/fileinput.min');
require('./js/theme.min');
require('./js/plugins/piexif.min');
require('./js/plugins/piexif');
require('./js/plugins/purify.min');
require('./js/plugins/sortable.min');
require('./js/locales/LANG');
require('./js/locales/ru');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
  
//Подключаем календарь 
$('input.date').datepicker({
    language: "ru"
});
//Впишите свой домен что-бы работали фото по умолчанию
var DOMEN = "work";
//Обрабатывает клик по ссылке для сортиров должностей по полю на странице должности
$('a.order_ajax').click(function(){
  //alert('Вы нажали на элемент "a"');
  // console.log(this.id);
  //console.log($('#input_'+this.id).attr('value'));
  var id = this.id;
  $('#span_'+this.id).attr('class',showGlyphicon($('#input_'+this.id).attr('value')))
  $('#input_'+this.id).attr('value',interpreterInput($('#input_'+this.id).attr('value')))
  $('a.order_ajax').each(function(i,elem) {
    //console.log(id+" - "+i+": "+elem.id);
    if(id.localeCompare(elem.id)!=0){
        $('#span_'+elem.id).attr('class',"");
        $('#input_'+elem.id).attr('value',"")
    }
  });
  var data = $('#my_form_ajax').serialize();
  $.ajax({
        url: '/ajaxpositions',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position').remove();
            //console.log('Удаление tr сработало');
            $("table").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
})

$('a.order').click(function(){
  //alert('Вы нажали на элемент "a"');
  //console.log(this.id);
  //console.log($('#input_'+this.id).attr('value'));
  var id = this.id;
  $('#span_'+this.id).attr('class',showGlyphicon($('#input_'+this.id).attr('value')))
  $('#input_'+this.id).attr('value',interpreterInput($('#input_'+this.id).attr('value')))
  $('a.order').each(function(i,elem) {
    //console.log(id+" - "+i+": "+elem.id);
    if(id.localeCompare(elem.id)!=0){
        $('#span_'+elem.id).attr('class',"");
        $('#input_'+elem.id).attr('value',"")
    }
  });
  $('#my_form').submit();
  //return false;
})

$('a.my_page').click(function(){
    //alert('Вы нажали на элемент "a"');
    //console.log(this.id);
    $('#input_page').attr('value',this.id);
    $('#my_form').submit();
    //return false;
})
//блок позваляет перелистывать страницы в worker, position
$('a.my_page_ajax').click(function(){
    //alert('Вы нажали на элемент "a"');
    //console.log(this.id);
    $('#input_page_ajax').attr('value',this.id);
    var data = $('#my_form_ajax').serialize();
    $.ajax({
        url: '/ajaxpositions',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position').remove();
            //console.log('Удаление tr сработало');
            $("table").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
    //return false;
});
$('.pagination').on('click', 'a.my_page_ajax', function(){
    //alert('Вы нажали на элемент "a"');
    //console.log(this.id);
    $('#input_page_ajax').attr('value',this.id);
    var data = $('#my_form_ajax').serialize();
    $.ajax({
        url: '/ajaxpositions',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position').remove();
            //console.log('Удаление tr сработало');
            $("table").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});
$("#btn").click(function(){
    var data = $('#my_form_ajax').serialize();
    $.ajax({
        url: '/ajaxpositions',
        type: 'POST',
        data: data,
        success: function(res){
            console.log(res);
            $('tr.position').remove();
            //console.log('Удаление tr сработало');
            $("table.table_position").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_position li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_position").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});

$("#newposition").click(function(){
    //alert('Нажата кнопка добавить');
    //console.log(this);
    this.style.display = 'none';
    $('#new_position').css('display', 'block');
    return false;
    //css(styleName, value)
})

$("#btn_back").click(function(){
    //alert('Нажата кнопкУ вернуться');
    $('#new_position').css('display', 'none');
    $('#newposition').css('display', ' inline-block');
    $('#li_error_name_position').text('');
    $('#error_name_position').css('display', 'none');
    return false;
    //css(styleName, value)
})

$('table').on('dblclick', '.nameposition', function(){
    //alert('Нажали td');
    var id = this.id.split('-');
    //console.log(('#span-name_position-'+id[2]));
    $('#span-name_position-'+id[2]).css('display', 'none');
    $('#my_form_ajax_update_name_position-'+id[2]).css('display', 'block');
    return false;
});
$('table').on('click', '.update-btn', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn');
    //console.log($('#li-error-name_position-'+id[1]));
    $('#li-error-name_position-'+id[1]).text('');
    //console.log($('#td-error-name_position-'+id[1]));
    $('#td-error-name_position-'+id[1]).css('display', 'none');    
    var name_position = $('#input-position-name_position-'+id[1]).val();
    //console.log(name_position);
    if(!empty(name_position)){
        var lengh = 100;
        if(name_position.length<=lengh){
            var data = $('#my_form_ajax_update_name_position-'+id[1]).serialize();
            $.ajax({
                url: '/ajaxupdateposition',
                type: 'POST',
                data: data,
                success: function(res){
                    console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#li-error-name_position-'+id[1]));
                        $('#li-error-name_position-'+id[1]).text(res.msg);
                        //console.log($('#td-error-name_position-'+id[1]));
                        $('#td-error-name_position-'+id[1]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#span-name_position-'+id[1]).text(name_position);
                            $('#span-name_position-'+id[1]).css('display', 'block');
                            $('#my_form_ajax_update_name_position-'+id[1]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        }else{
            //console.log($('#li-error-name_position-'+id[1]));
            $('#li-error-name_position-'+id[1]).text('Ошибка - название должности должно быть не больше '+lengh+' символов!!!');
            //console.log($('#td-error-name_position-'+id[1]));
            $('#td-error-name_position-'+id[1]).css('display', 'table-cell');
            return false;
        }
    }else{
        //console.log($('#li-error-name_position-'+id[1]));
        $('#li-error-name_position-'+id[1]).text('Ошибка - заполните поле название должности!!!');
        //console.log($('#td-error-name_position-'+id[1]));
        $('#td-error-name_position-'+id[1]).css('display', 'table-cell');
        return false;
    }
    
    //console.log(data);
    return false;
    
});

$('table').on('dblclick', '.description_position', function(){
    //alert('Нажали td');
    var id = this.id.split('-');
    //console.log(('#span-description_position-'+id[2]));
    $('#span-description_position-'+id[2]).css('display', 'none');
    $('#my_form_ajax_update_description_position-'+id[2]).css('display', 'block');
    return false;
});

$('table').on('click', '.update-btn-description_position', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn-description_position');
    //console.log($('#li-error-name_position-'+id[1]));
    $('#li-error-name_position-'+id[1]).text('');
    //console.log($('#td-error-name_position-'+id[1]));
    $('#td-error-name_position-'+id[1]).css('display', 'none');
            var description_position = $('#input-position-description_position-'+id[1]).val();
            var data = $('#my_form_ajax_update_description_position-'+id[1]).serialize();
            //console.log(description_position);
            $.ajax({
                url: '/ajaxupdateposition',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#li-error-name_position-'+id[1]));
                        $('#li-error-name_position-'+id[1]).text(res.msg);
                        //console.log($('#td-error-name_position-'+id[1]));
                        $('#td-error-name_position-'+id[1]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#span-description_position-'+id[1]).text(description_position);
                            $('#span-description_position-'+id[1]).css('display', 'block');
                            $('#my_form_ajax_update_description_position-'+id[1]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        
    
});

$('table').on('click', '.btn-delete', function(){
    //console.log(this.id);
    var id = this.id.split('-');
    var r = confirm("Вы точно хотите удалить должность?");
    if (r == true) {
        //console.log(id);
        var data = $('#my_form_ajax_delete_position-'+id[2]).serialize();
            $.ajax({
                url: '/ajaxdeleteposition',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 200){
                        $('#ul-error').css('display', 'block');
                        $('#li-error').text(res.msg);
                        $("#position-"+id[2]).remove()
                        setTimeout(uldelete, 5000);
                    }else{
                        //console.log($('#li-error-name_position-'+id[2]));
                        $('#li-error-name_position-'+id[2]).text(res.msg);
                        //console.log($('#td-error-name_position-'+id[1]));
                        $('#td-error-name_position-'+id[2]).css('display', 'table-cell');
                        return false;
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
    }else{        
        return false;
    }

})

function uldelete(){
    $('#ul-error').css('display', 'none');
    $('#li-error').text('');
    //console.log('Закрыли ответ');
}
function uldeletenNewDelete(){
    $('#ul-error-new-worker').css('display', 'none');
    $('#li-error-new-worker').text('');
    //console.log('Закрыли ответ');
}

$("#btn_newpas").click(function(){
    //alert('Нажата кнопкУ добавить');
    //console.log($('#newposition-name_position[name = name_position]').val());
    var name_position = $('#newposition-name_position[name = name_position]').val();
    if(!empty(name_position)){
        //alert('name_position не пустая');
        var lengh = 100;
        if(name_position.length<=lengh){
            var data = $('#my_form_ajax_newPosition').serialize();
            $.ajax({
                url: '/ajaxnewpost',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //alert('name_position пустая');
                        //console.log($('#li_error_name_position'));
                        $('#li_error_name_position').text(res.msg);
                        //console.log($('#error_name_position'));
                        $('#error_name_position').css('display', 'block');
                        return false;
                    }else{
                        //console.log(res);
                        $('tr.position').remove();
                        //console.log('Удаление tr сработало');
                        $("table").append(res.msg);
                        //console.log('Добовление tr сработало');
                        $('ul.pagination li').remove();
                        //console.log('Удаление li pagination сработало');
                        $("ul.pagination").append(res.pg);
                        //console.log('Добовление li в pagination сработало');
                        $('#new_position').css('display', 'none');
                        $('#newposition').css('display', ' inline-block');
                        $('#li_error_name_position').text('');
                        $('#error_name_position').css('display', 'none');
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        }else{
            //alert('name_position пустая');
            //console.log($('#li_error_name_position'));
            $('#li_error_name_position').text('Ошибка - название должности должно быть не больше '+lengh+' символов!!!');
            //console.log($('#error_name_position'));
            $('#error_name_position').css('display', 'block');
            return false;
        }
    }else{
        //alert('name_position пустая');
        //console.log($('#li_error_name_position'));
        $('#li_error_name_position').text('Ошибка - заполните поле название должности!!!');
        //console.log($('#error_name_position'));
        $('#error_name_position').css('display', 'block');
        return false;
    }
    return false;
    //css(styleName, value)
});

function showGlyphicon(valueInput) {
    if(valueInput == "" ){
        return "glyphicon glyphicon-sort-by-attributes";
    }else{
        if(valueInput.localeCompare("ASC")!=0){
           return "glyphicon glyphicon-sort-by-attributes-alt"; 
        }else{
           return "glyphicon glyphicon-sort-by-attributes"; 
        }
    }
}

function interpreterInput(valueInput) {
    if(valueInput == "" ){
        return "DESC";
    }else{
        if(valueInput.localeCompare("ASC")!=0){
           return "ASC"; 
        }else{
           return "DESC"; 
        }
    }
}

function empty(e) {
  switch (e) {
    case "":
    case 0:
    case "0":
    case null:
    case false:
    case typeof this == "undefined":    
      return true;
    default:
      return false;
  }
}
if($('#file-fr').is('#file-fr')){
    $('#file-fr').fileinput({
        language: 'ru',
        showRemove: false,
        showCancel: false,
        fileActionSettings:{
            showUpload: false,
            showRemove: false,
        },
        initialPreview:getImgPreview(),
        initialPreviewShowDelete: false,
    });
}

function getImgPreview(){
    //console.log($('#img_photo').attr('src'));
    var src = $('#img_photo').attr('src').split('/');
    //console.log(src);
    if(src[5].localeCompare('default')==0){
        return '';
    }else{
        return "<img id='img_photo' src='"+$('#img_photo').attr('src')+"' style=' width: 200px; height: 200px;'>";
    }    
}
//Ссылки сортировки
$('a.order_ajax_workers').click(function(){
  //alert('Вы нажали на элемент "a"');
  //console.log(this.id);
  //console.log($('#input_'+this.id).attr('value'));
  var id = this.id;
  $('#span_'+this.id).attr('class',showGlyphicon($('#input_'+this.id).attr('value')))
  $('#input_'+this.id).attr('value',interpreterInput($('#input_'+this.id).attr('value')))
  $('a.order_ajax_workers').each(function(i,elem) {
    //console.log(id+" - "+i+": "+elem.id);
    if(id.localeCompare(elem.id)!=0){
        $('#span_'+elem.id).attr('class',"");
        $('#input_'+elem.id).attr('value',"")
    }
  });
  var data = $('#my_form_ajax_workers').serialize();
  $.ajax({
        url: '/ajaxworkers',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.worker').remove();
            //console.log('Удаление tr сработало');            
            $("table.my_table_workers").append(res.msg);
            //console.log('Добовление tr сработало');
            
            $('ul.pagination_workers li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_workers").append(res.pg);
            //console.log('Добовление li в pagination сработало');
            
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});
//Пагинатор
$('.pagination').on('click', 'a.my_page_ajax_workers', function(){
    //alert('Вы нажали на элемент "a"');
    //console.log(this.id);
    $('#input_page_ajax').attr('value',this.id);
    var data = $('#my_form_ajax_workers').serialize();
    $.ajax({
        url: '/ajaxworkers',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res); 
            $('tr.worker').remove();
            //console.log('Удаление tr сработало');
            $("table.my_table_workers").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_workers li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_workers").append(res.pg);
            //console.log('Добовление li в pagination сработало');
            
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});
//Поиск  тут
$("#btn_serch_workers").click(function(){
    var data = $('#my_form_ajax_workers').serialize();
    $.ajax({
        url: '/ajaxworkers',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.worker').remove();
            //console.log('Удаление tr сработало');
            $("table.my_table_workers").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_workers li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_workers").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});
//Обработчик двойного клика для td worker_surname
$('table').on('dblclick', '.worker_surname', function(){
    //alert('Нажали td');
    var id = this.id.split('-');
    //console.log(('#span-surname-'+id[2]));
    $('#span-surname-'+id[2]).css('display', 'none');
    $('#my_form_ajax_worker_update_surname-'+id[2]).css('display', 'block');
    return false;
});

$('table').on('click', '.update-worker-surname-btn', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn');
    //console.log($('#li-error-worker-'+id[3]));
    $('#li-error-worker-'+id[3]).text('');
    //console.log($('#td-error-worker-'+id[3]));
    $('#td-error-worker-'+id[3]).css('display', 'none');    
    var surname = $('#input-worker-surname-'+id[3]).val();
    //console.log(surname);
    
    if(!empty(surname)){
        var lengh = 100;
        if(surname.length<=lengh){
            var data = $('#my_form_ajax_worker_update_surname-'+id[3]).serialize();
            $.ajax({
                url: '/ajaxupdateworker',
                type: 'POST',
                data: data,
                success: function(res){
                    console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#li-error-worker-'+id[3]));
                        $('#li-error-worker-'+id[3]).text(res.msg);
                        //console.log($('#td-error-worker-'+id[2]));
                        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#span-surname-'+id[3]).text(surname);
                            $('#span-surname-'+id[3]).css('display', 'block');
                            $('#my_form_ajax_worker_update_surname-'+id[3]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        }else{
            //console.log("Слишком длинный");
            //console.log($('#li-error-worker-'+id[2]));
            $('#li-error-worker-'+id[3]).text('Ошибка - Фамилия должна быть не больше '+lengh+' символов!!!');
            //console.log($('#td-error-worker-'+id[3]));
            $('#td-error-worker-'+id[3]).css('display', 'table-cell');
            return false;
        }
    }else{
        //console.log($('#li-error-worker-'+id[3]));
        $('#li-error-worker-'+id[3]).text('Ошибка - заполните поле Фамилия!!!');
        //console.log($('#td-error-worker-'+id[2]));
        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
        return false;
    }
    
    //console.log(data);
    return false;
    
});

//Обработчик двойного клика для td worker_name
$('table').on('dblclick', '.worker_name', function(){
    //alert('Нажали td');
    var id = this.id.split('-');
    //console.log(('#span-name-'+id[2]));
    $('#span-name-'+id[2]).css('display', 'none');
    $('#my_form_ajax_worker_update_name-'+id[2]).css('display', 'block');
    return false;
});

$('table').on('click', '.update-worker-name-btn', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn');
    //console.log($('#li-error-worker-'+id[3]));
    $('#li-error-worker-'+id[3]).text('');
    //console.log($('#td-error-worker-'+id[3]));
    $('#td-error-worker-'+id[3]).css('display', 'none');    
    var name = $('#input-worker-name-'+id[3]).val();
    //console.log(name);
    
    if(!empty(name)){
        var lengh = 100;
        if(name.length<=lengh){
            var data = $('#my_form_ajax_worker_update_name-'+id[3]).serialize();
            $.ajax({
                url: '/ajaxupdateworker',
                type: 'POST',
                data: data,
                success: function(res){
                    console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#li-error-worker-'+id[3]));
                        $('#li-error-worker-'+id[3]).text(res.msg);
                        //console.log($('#td-error-worker-'+id[2]));
                        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#span-name-'+id[3]).text(name);
                            $('#span-name-'+id[3]).css('display', 'block');
                            $('#my_form_ajax_worker_update_name-'+id[3]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        }else{
            //console.log("Слишком длинный");
            //console.log($('#li-error-worker-'+id[2]));
            $('#li-error-worker-'+id[3]).text('Ошибка - Имя должно быть не больше '+lengh+' символов!!!');
            //console.log($('#td-error-worker-'+id[3]));
            $('#td-error-worker-'+id[3]).css('display', 'table-cell');
            return false;
        }
    }else{
        //console.log($('#li-error-worker-'+id[3]));
        $('#li-error-worker-'+id[3]).text('Ошибка - заполните поле Имя!!!');
        //console.log($('#td-error-worker-'+id[2]));
        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
        return false;
    }
    
    //console.log(data);
    return false;
    
});

//Обработчик двойного клика для td worker_patronymic
$('table').on('dblclick', '.worker_patronymic', function(){
    //alert('Нажали td');
    var id = this.id.split('-');
    //console.log(('#span-patronymic-'+id[2]));
    $('#span-patronymic-'+id[2]).css('display', 'none');
    $('#my_form_ajax_worker_update_patronymic-'+id[2]).css('display', 'block');
    return false;
});

$('table').on('click', '.update-worker-patronymic-btn', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn');
    //console.log($('#li-error-worker-'+id[3]));
    $('#li-error-worker-'+id[3]).text('');
    //console.log($('#td-error-worker-'+id[3]));
    $('#td-error-worker-'+id[3]).css('display', 'none');    
    var patronymic = $('#input-worker-patronymic-'+id[3]).val();
    //console.log(patronymic);
    
    if(!empty(patronymic)){
        var lengh = 100;
        if(patronymic.length<=lengh){
            var data = $('#my_form_ajax_worker_update_patronymic-'+id[3]).serialize();
            $.ajax({
                url: '/ajaxupdateworker',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#li-error-worker-'+id[3]));
                        $('#li-error-worker-'+id[3]).text(res.msg);
                        //console.log($('#td-error-worker-'+id[2]));
                        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#span-patronymic-'+id[3]).text(patronymic);
                            $('#span-patronymic-'+id[3]).css('display', 'block');
                            $('#my_form_ajax_worker_update_patronymic-'+id[3]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        }else{
            //console.log("Слишком длинный");
            //console.log($('#li-error-worker-'+id[2]));
            $('#li-error-worker-'+id[3]).text('Ошибка - Фамилия должна быть не больше '+lengh+' символов!!!');
            //console.log($('#td-error-worker-'+id[3]));
            $('#td-error-worker-'+id[3]).css('display', 'table-cell');
            return false;
        }
    }else{
        //console.log($('#li-error-worker-'+id[3]));
        $('#li-error-worker-'+id[3]).text('Ошибка - заполните поле Фамилию!!!');
        //console.log($('#td-error-worker-'+id[2]));
        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
        return false;
    }
    
    //console.log(data);
    return false;
    
});

//Обработчик двойного клика для td worker_salary
$('table').on('dblclick', '.worker_salary', function(){
    //alert('Нажали td salary');
    var id = this.id.split('-');
    //console.log(('#span-salary-'+id[2]));
    $('#span-salary-'+id[2]).css('display', 'none');
    $('#my_form_ajax_worker_update_salary-'+id[2]).css('display', 'block');
    return false;
});

$('table').on('click', '.update-worker-salary-btn', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn salary');
    //console.log($('#li-error-worker-'+id[3]));
    $('#li-error-worker-'+id[3]).text('');
    //console.log($('#td-error-worker-'+id[3]));
    $('#td-error-worker-'+id[3]).css('display', 'none');    
    var salary = $('#input-worker-salary-'+id[3]).val();
    //console.log(salary);
    
    if(!empty(salary)){
        if(!isNaN(salary)){
            var data = $('#my_form_ajax_worker_update_salary-'+id[3]).serialize();
            $.ajax({
                url: '/ajaxupdateworker',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#li-error-worker-'+id[3]));
                        $('#li-error-worker-'+id[3]).text(res.msg);
                        //console.log($('#td-error-worker-'+id[2]));
                        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#span-salary-'+id[3]).text(salary);
                            $('#span-salary-'+id[3]).css('display', 'block');
                            $('#my_form_ajax_worker_update_salary-'+id[3]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        }else{
            //console.log("Слишком длинный");
            //console.log($('#li-error-worker-'+id[2]));
            $('#li-error-worker-'+id[3]).text('Ошибка - Зарплата должна быть числом!!!');
            //console.log($('#td-error-worker-'+id[3]));
            $('#td-error-worker-'+id[3]).css('display', 'table-cell');
            return false;
        }
    }else{
        //console.log($('#li-error-worker-'+id[3]));
        $('#li-error-worker-'+id[3]).text('Ошибка - заполните поле зарплата!!!');
        //console.log($('#td-error-worker-'+id[2]));
        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
        return false;
    }
    
    //console.log(data);
    return false;
    
});

//Обработчик двойного клика для td worker_date_receipt
$('table').on('dblclick', '.worker_date_receipt', function(){
    //alert('Нажали td date_receipt');
    $('input.date').datepicker({
        language: "ru"
    });
    var id = this.id.split('-');
    //console.log(('#span-date_receipt-'+id[2]));
    $('#span-date_receipt-'+id[2]).css('display', 'none');
    $('#my_form_ajax_worker_update_date_receipt-'+id[2]).css('display', 'block');
    return false;
});

$('table').on('click', '.update-worker-date_receipt-btn', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn date_receipt');
    //console.log($('#li-error-worker-'+id[3]));
    $('#li-error-worker-'+id[3]).text('');
    //console.log($('#td-error-worker-'+id[3]));
    $('#td-error-worker-'+id[3]).css('display', 'none');    
    var date_receipt = $('#input-worker-date_receipt-'+id[3]).val();
    //console.log(date_receipt);    
    if(!empty(date_receipt)){
            var data = $('#my_form_ajax_worker_update_date_receipt-'+id[3]).serialize();
            $.ajax({
                url: '/ajaxupdateworker',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#li-error-worker-'+id[3]));
                        $('#li-error-worker-'+id[3]).text(res.msg);
                        //console.log($('#td-error-worker-'+id[2]));
                        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#span-date_receipt-'+id[3]).text(date_receipt);
                            $('#span-date_receipt-'+id[3]).css('display', 'block');
                            $('#my_form_ajax_worker_update_date_receipt-'+id[3]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
    }else{
        //console.log($('#li-error-worker-'+id[3]));
        $('#li-error-worker-'+id[3]).text('Ошибка - заполните поле приняли на работу!!!');
        //console.log($('#td-error-worker-'+id[2]));
        $('#td-error-worker-'+id[3]).css('display', 'table-cell');
        return false;
    }
    
    //console.log(data);
    return false;
    
});

//Обработчик двойного клика для td worker_photo
$('table').on('dblclick', '.worker_photo', function(){
    //alert('Нажали td worker_photo');    
    var id = this.id.split('-');
    //console.log(id);
    //console.log( $('input[name="_token"]').val());
    $('#file-fr-'+id[2]).fileinput({
        language: 'ru',
        //theme: 'fa',
        required: true,
        uploadUrl: "/ajaxupdateworkerphoto",
        minFileCount: 1,
        maxFileCount: 1,
        showRemove: false,
        showCancel: false,
        fileActionSettings:{
            showUpload: false,
        },
        initialPreview:getImgPreviewAjax(id[2]),
        initialPreviewConfig: getImgPreviewConfigAjax(id[2]),
        initialPreviewShowDelete: false,
        uploadExtraData: {
            id:id[2],
            '_token':$('input[name="_token"]').val(),
        },
    });
    $('#myModal-'+id[2]).modal();
    return false;
});
$('table').on('hidden.bs.modal', '.modal', function (e) {
    alert('вы закрыли модальное окно');
    console.log(this.id);
    var id = this.id.split('-');
    console.log("id-"+id[1]);
    if($('#img_photo_preview-'+id[1]).is('#img_photo_preview-'+id[1])){
        console.log('есть фото');
        console.log($('#img_photo_preview-'+id[1]));
        $('#img-'+id[1]).attr('src',$('#img_photo_preview-'+id[1]).attr('src'));
    }else{
         console.log('Элемент не найден');
         console.log($('#img_photo_preview-'+id[1]));
         $('#img-'+id[1]).attr('src',"http://"+DOMEN+"/storage/foto/default/avatar5.png");
    }
});
function getImgPreviewAjax(id){
    //console.log($('#img_photo-'+id).attr('src'));
    var src = $('#img_photo-'+id).attr('src').split('/');
    //console.log(src);
    if(src[5].localeCompare('default')==0){
        //console.log('Сработал по умолчанию');
        return '';
    }else{
        //console.log('Сработал не по умолчанию');
        //console.log("<img id='img_photo'  src='"+$('#img_photo-'+id).attr('src')+"' style=' width: 200px; height: 200px;'>");
        return "<img id='img_photo-"+id+"' class='file-preview-image' src='"+$('#img_photo-'+id).attr('src')+"' style=' width: 200px; height: 200px;'>";
    }
}

function getImgPreviewConfigAjax(id){
    //console.log($('#img_photo-'+id).attr('src'));
    var src = $('#img_photo-'+id).attr('src').split('/');
    //console.log(src);
    if(src[5].localeCompare('default')==0){
        //console.log('Сработал по умолчанию');
        return '';
    }else{
        //console.log('Сработал не по умолчанию');
        return [
            {
                caption: src[6], 
                width: '120px', 
                url: '/ajaxdeleteworkerphoto', 
                key: 100, 
                extra: {
                    id: id,
                    '_token':$('input[name="_token"]').val(),
                }
            }
        ];
    }
}

//Обработчик двойного клика для td
$('table').on('dblclick', '.worker_position', function(){
    //alert('Нажали td worker_position');    
    var id = this.id.split('-');
    //console.log(id);
    $('#modal_worker_id').attr('value',id[2]);
    $('#myModal-positions').modal();
    return false;
});

//Обрабатывает клик по ссылке для сортиров должностей по полю на странице работники в модальном окне 

//Обрабатывает клик по ссылке для сортиров должностей по полю на странице работники в модальном окне 
$('a.order_ajax_modal').click(function(){
  //alert('Вы нажали на элемент "a" position worker mdal');
  //console.log(this.id);
  //console.log($('#input_'+this.id).attr('value'));
  var id = this.id;
  $('#span_modal_'+this.id).attr('class',showGlyphicon($('#input_modal_'+this.id).attr('value')))
  $('#input_modal_'+this.id).attr('value',interpreterInput($('#input_modal_'+this.id).attr('value')))
  $('a.order_ajax_modal').each(function(i,elem) {
    //console.log(id+" - "+i+": "+elem.id);
    if(id.localeCompare(elem.id)!=0){
        $('#span_modal_'+elem.id).attr('class',"");
        $('#input_modal_'+elem.id).attr('value',"")
    }
  });
  var data = $('#my_form_ajax').serialize();
  $.ajax({
        url: '/ajaxindexmodal',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position').remove();
            //console.log('Удаление tr сработало');
            $("table.table_position_modal").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_modal li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_modal").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
})

//блок позваляет перелистывать страницы в worker в модальном окне position
$('a.my_position_page_ajax').click(function(){
    //alert('Вы нажали на элемент "a"');
    //console.log(this.id);
    $('#input_position_page_ajax').attr('value',this.id);
    var data = $('#my_form_ajax').serialize();
    $.ajax({
        url: '/ajaxindexmodal',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position').remove();
            //console.log('Удаление tr сработало');
            $("table.table_position_modal").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_position li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_position").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});
$('.pagination_position').on('click', 'a.my_position_page_ajax', function(){
    //alert('Вы нажали на элемент "a"');
    //console.log(this.id);
    $('#input_position_page_ajax').attr('value',this.id);
    var data = $('#my_form_ajax').serialize();
    $.ajax({
        url: '/ajaxindexmodal',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position').remove();
            //console.log('Удаление tr сработало');
            $("table.table_position_modal").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_position li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_position").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});

$("#btn_modal").click(function(){
    var data = $('#my_form_ajax').serialize();
    $.ajax({
        url: '/ajaxindexmodal',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position').remove();
            //console.log('Удаление tr сработало');
            $("table.table_position_modal").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_position li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_position").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});

//обработчик кнопки заменить в модальном окне должность

$('table.table_position_modal').on('click', '.btn-position-change', function(){
    var id = this.id.split('-');
    //console.log(id);
    //console.log($('#modal_worker_id'));
    //console.log($('#modal_worker_id').attr('value'));
    $('#worker_id-'+id[3]).attr('value',$('#modal_worker_id').attr('value'));
    //console.log($('#change-position-'+id[3]));
    var data = $('#change-position-'+id[3]).serialize();
    //console.log(data);
    $.ajax({
        url: '/ajaxupdateworkerposition',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            var worker_id = $('#modal_worker_id').attr('value')
            if(res[0] == 0){               
                //console.log($('#li-error-worker-'+worker_id));
                $('#li-error-worker-'+worker_id).text(res.msg);
                //console.log($('#td-error-worker-'+worker_id));
                $('#td-error-worker-'+worker_id).css('display', 'table-cell');
                $('#myModal-positions').modal('hide');
                return false;
            }else{
                if(res[0] == 200){
                    $('#worker-position-'+worker_id).text(res.position);
                    //$('#worker-position-'+worker_id).css('display', 'block');
                    $('#ul-error').css('display', 'block');
                    $('#li-error').text(res.msg);
                    setTimeout(uldelete, 5000);
                    $('#myModal-positions').modal('hide');
                    return false;
                }
            }
            
        },            
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
    
});
//Блок дабовления нового работника
//скрываем кнопку добавить работника и показываем форму добавления
$("#newworker").click(function(){
    //console.log(this);
    this.style.display = 'none';
    $('#new_worker').css('display', 'block');
    return false;
})
//Скрывает форму добавит работника и показывает кнопку
$("#btn_back_new_worker").click(function(){
    $('#new_worker').css('display', 'none');
    $('#newworker').css('display', ' inline-block');
    return false;
})

//обрабатываем кнопку Шаг
$("#btn_step").click(function(){
    //alert('вы нажали btn_step');
    ///console.log($("#step").val());
    var step = Number($("#step").val());
    switch (step){
        case 1:
            remoowAlterMesege();
            //console.log('вы на первом шаге');
            //console.log($("#worker-surname-ajax").val());
            
            if(empty($("#worker-surname-ajax").val())){
                //console.log('Пустое поле');
                $("#div-worker-surname-ajax").append(alertMesege("Заполнить поле Фамилия","surname"));
                break;
            }            
            if(empty($("#worker-name-ajax").val())){
                //console.log('Пустое поле');
                $("#div-worker-name-ajax").append(alertMesege("Заполнить поле Имя","name"));
                break;
            }            
            if(empty($("#worker-patronymic-ajax").val())){
                //console.log('Пустое поле');
                $("#div-worker-patronymic-ajax").append(alertMesege("Заполнить поле Фамилмя","patronymic"));
                break;
            }            
            if(empty($("#worker-salary-ajax").val())){
                //console.log('Пустое поле');
                $("#div-worker-salary-ajax").append(alertMesege("Заполните поле зарплаты","salary"));
                break;
            }else{
                if(!empyNumber($("#worker-salary-ajax").val())){
                    //console.log('Пустое поле');
                    $("#div-worker-salary-ajax").append(alertMesege("Введите правильно зарплату","salary"));
                    break;
                }    
            }
            if(empty($("#worker-date_receipt-ajax").val())){
                //console.log('Пустое поле');
                $("#div-worker-date_receipt-ajax").append(alertMesege("Заполнить поле Дата приема на работу","date_receipt"));
                break;
            }
            $('#step1').css('display', 'none');
            $('#btn_step').text("Шаг 2");
            $('#step').attr('value',2);
            $('#step2').css('display', 'block');
            break;
        case 2:
            $('#step2').css('display', 'none');
            $('#step').attr('value',3);
            $('#btn_step').text("Сохранить");
            $('#step3').css('display', 'block');
            break;
        case 3:
            //console.log('вы на ретьем шаге');
            var data = $('#my_form_new_worker').serialize();
            $.ajax({
                url: '/creatajaxworker',
                type: 'POST',
                data: data,
                success: function(res){
                    if(res[0]==0){
                        switch (Number(res.step)){
                            case 0:
                                $('#ul-error-new-worker').css('display', 'block');
                                $('#li-error-new-worker').text(res.msg);
                                setTimeout(uldeletenNewDelete, 5000);
                                break;
                            case 1:
                                $('#ul-error-new-worker').css('display', 'block');
                                $('#li-error-new-worker').text(res.msg);
                                setTimeout(uldeletenNewDelete, 5000);
                                $('#step3').css('display', 'none');
                                $('#step2').css('display', 'none');
                                $('#step').attr('value',1);
                                $('#btn_step').text("Шаг 1");
                                $('#step1').css('display', 'block');
                                break;
                            case 2:
                                $('#ul-error-new-worker').css('display', 'block');
                                $('#li-error-new-worker').text(res.msg);
                                setTimeout(uldeletenNewDelete, 5000);
                                $('#step3').css('display', 'none');
                                $('#step1').css('display', 'none');
                                $('#step').attr('value',2);
                                $('#btn_step').text("Шаг 2");
                                $('#step2').css('display', 'block');
                                break;
                            case 3:
                                $('#ul-error-new-worker').css('display', 'block');
                                $('#li-error-new-worker').text(res.msg);
                                setTimeout(uldeletenNewDelete, 5000);
                                $('#step1').css('display', 'none');
                                $('#step2').css('display', 'none');
                                $('#step').attr('value',3);
                                $('#btn_step').text("Сохранить");
                                $('#step3').css('display', 'block');
                                break;
                            default:
                                console.log('res.step пришел с неизвестнвм параметром');
                        }        
                    }else{
                        //console.log(res.msg);
                        $('#step3').css('display', 'none');
                        $('#teble-selection').css('display', 'none');
                        $('#worker_selection').css('display', 'block');
                        $('#worker-id_worker-ajax').attr('value',0);
                        $('#step2').css('display', 'none');
                        $('.chek_table_position_new_worker').css('display', 'none');
                        $('#position_selection').css('display', 'block');
                        $('#worker-id_position-ajax').attr('value',0);
                        $('#step1').css('display', 'block');
                        $('#worker-surname-ajax').val('');
                        $('#worker-name-ajax').val('');
                        $('#worker-patronymic-ajax').val('');
                        $('#worker-salary-ajax').val('');
                        $('#worker-date_receipt-ajax').val('');
                        $('#step').attr('value',1);
                        $('#btn_step').text("Шаг 1");
                        $('#new_worker').css('display', 'none');
                        $('#newworker').css('display', ' inline-block');    
                        $("table.my_table_workers").append(res.msg);
                        return false;
                    }    
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            break;
        default:
            alert( 'Я таких значений не знаю' );    
    }
    return false;
})

function alertMesege(msg, name){
    return "<div id='alert-worker-"+name+"-ajax'  class='alert alert-danger alert-dismissable' style='margin-top:10px;'>"
                +"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
                +msg
            +"</div>";
}
function remoowAlterMesege(){
    $("#alert-worker-surname-ajax").remove();
    $("#alert-worker-name-ajax").remove();
    $("#alert-worker-patronymic-ajax").remove();
    $("#alert-worker-salary-ajax").remove();
    $("#alert-worker-date_receipt-ajax").remove();
}

function empyNumber(number){
    var defult = "0123456789";
    var point = ".";
    var comma = ",";
    var counterDefult = 0;
    var counterTwo = 0;
    var found = 0;
    for(var i=0; i<number.length; i++){
        for(var j=0; j<defult.length; j++){
            if(number.charAt(i)==defult.charAt(j)){
                counterDefult++;
                if(found==1){
                    counterTwo++;
                }
            }
        }
        if(counterDefult==0){
            if(number.charAt(i) == point.charAt(0) || number.charAt(i) == comma.charAt(0)){
               found++;
               if(found>1){
                   return false;
               }
            }else{
                return false;
            }
        }
        if(counterTwo>2){
            return false;
        }
        counterDefult=0;
    }
    return true;
}

//Обрабатывает клик по ссылке для сортировки должностей по полю на странице работники в в форме добовления нового работника 
$('a.order_ajax_new_worker').click(function(){
  //alert('Вы нажали на элемент "a" new worker');
  //console.log(this.id);
  //console.log($('#input_'+this.id).attr('value'));
  var id = this.id;
  $('#span_new_worker_'+this.id).attr('class',showGlyphicon($('#input_new_worker_'+this.id).attr('value')))
  $('#input_new_worker_'+this.id).attr('value',interpreterInput($('#input_new_worker_'+this.id).attr('value')))
  $('a.order_ajax_new_worker').each(function(i,elem) {
    //console.log(id+" - "+i+": "+elem.id);
    if(id.localeCompare(elem.id)!=0){
        $('#span_new_worker_'+elem.id).attr('class',"");
        $('#input_new_worker_'+elem.id).attr('value',"")
    }
  });
  var data = $('#new_worker_my_form_ajax').serialize();
  $.ajax({
        url: '/ajaxindexnewworker',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position_new_worker').remove();
            //console.log('Удаление tr сработало');
            $("table.table_position_new_worker").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_new_worker li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_new_worker").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
})
//Обрабатываем нажатие скрытой кнопки
$("#btn_new_worker_serch").click(function(){
    var data = $('#new_worker_my_form_ajax').serialize();
    $.ajax({
        url: '/ajaxindexnewworker',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position_new_worker').remove();
            //console.log('Удаление tr сработало');
            $("table.table_position_new_worker").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_new_worker li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_new_worker").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});
//
$('.pagination_new_worker').on('click', 'a.my_position_page_ajax_new_worker', function(){
    //alert('Вы нажали на элемент "a"');
    //console.log(this.id);
    $('#input_position_page_new_worker_ajax').attr('value',this.id);
    var data = $('#new_worker_my_form_ajax').serialize();
    $.ajax({
        url: '/ajaxindexnewworker',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.position_new_worker').remove();
            //console.log('Удаление tr сработало');
            $("table.table_position_new_worker").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.pagination_new_worker li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.pagination_new_worker").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});
//Редактировать название должности в добовлении должности
$('table').on('dblclick', '.nameposition_new_worker', function(){
    //alert('Нажали td nameposition_new_worker');
    var id = this.id.split('-');
    //console.log(('#new-worker-span-name_position-'+id[2]));
    $('#new-worker-span-name_position-'+id[2]).css('display', 'none');
    $('#new-worker-my_form_ajax_update_name_position-'+id[2]).css('display', 'block');
    return false;
});
$('table').on('click', '.new-worker-update-btn-nameposition', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn');
    //console.log($('#new-worker-li-error-name_position-'+id[1]));
    $('#new-worker-li-error-name_position-'+id[1]).text('');
    //console.log($('#new-worker-td-error-name_position-'+id[1]));
    $('#new-worker-td-error-name_position-'+id[1]).css('display', 'none');    
    var name_position = $('#new-worker-input-position-name_position-'+id[1]).val();
    //console.log(name_position);
    if(!empty(name_position)){
        var lengh = 100;
        if(name_position.length<=lengh){
            var data = $('#new-worker-my_form_ajax_update_name_position-'+id[1]).serialize();
            $.ajax({
                url: '/ajaxupdateposition',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#new-worker-li-error-name_position-'+id[1]));
                        $('#new-worker-li-error-name_position-'+id[1]).text(res.msg);
                        //console.log($('#new-worker-td-error-name_position-'+id[1]));
                        $('#new-worker-td-error-name_position-'+id[1]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#new-worker-span-name_position-'+id[1]).text(name_position);
                            $('#new-worker-span-name_position-'+id[1]).css('display', 'block');
                            $('#new-worker-my_form_ajax_update_name_position-'+id[1]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        }else{
            //console.log($('#new-worker-li-error-name_position-'+id[1]));
            $('#new-worker-li-error-name_position-'+id[1]).text('Ошибка - название должности должно быть не больше '+lengh+' символов!!!');
            //console.log($('#new-worker-td-error-name_position-'+id[1]));
            $('#new-worker-td-error-name_position-'+id[1]).css('display', 'table-cell');
            return false;
        }
    }else{
        //console.log($('#new-worker-li-error-name_position-'+id[1]));
        $('#new-worker-li-error-name_position-'+id[1]).text('Ошибка - заполните поле название должности!!!');
        //console.log($('#new-worker-td-error-name_position-'+id[1]));
        $('#new-worker-td-error-name_position-'+id[1]).css('display', 'table-cell');
        return false;
    }
    
    //console.log(data);
    return false;
    
});
//Редактировать описание должности
$('table').on('dblclick', '.description_position_new_worker', function(){
    //alert('Нажали td description_position_new_worker');
    var id = this.id.split('-');
    //console.log(('#new-worker-span-description_position-'+id[2]));
    $('#new-worker-span-description_position-'+id[2]).css('display', 'none');
    $('#new-worker-my_form_ajax_update_description_position-'+id[2]).css('display', 'block');
    return false;
});

$('table').on('click', '.new-worker-update-btn-description_position', function(){
    var id = this.id.split('-');
    //console.log(this); 
    //alert('Нажали update-btn-description_position');
    //console.log($('#new-worker-li-error-name_position-'+id[1]));
    $('#new-worker-li-error-name_position-'+id[1]).text('');
    //console.log($('#new-worker-td-error-name_position-'+id[1]));
    $('#new-worker-td-error-name_position-'+id[1]).css('display', 'none');
            var description_position = $('#new-worker-input-position-description_position-'+id[1]).val();
            var data = $('#new-worker-my_form_ajax_update_description_position-'+id[1]).serialize();
            //console.log(description_position);
            $.ajax({
                url: '/ajaxupdateposition',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res[0]);
                    //alert(res[0]);
                    if(res[0] == 0){
                        //console.log($('#new-worker-li-error-name_position-'+id[1]));
                        $('#new-worker-li-error-name_position-'+id[1]).text(res.msg);
                        //console.log($('#new-worker-td-error-name_position-'+id[1]));
                        $('#new-worker-td-error-name_position-'+id[1]).css('display', 'table-cell');
                        return false;
                    }else{
                        if(res[0] == 200){
                            $('#new-worker-span-description_position-'+id[1]).text(description_position);
                            $('#new-worker-span-description_position-'+id[1]).css('display', 'block');
                            $('#new-worker-my_form_ajax_update_description_position-'+id[1]).css('display', 'none');
                            $('#ul-error').css('display', 'block');
                            $('#li-error').text(res.msg);
                            setTimeout(uldelete, 5000);
                            return false;
                        }
                    }
            
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
            return false;
        
    
});

//обрабатываем кнопку выбрать при добавлении роботника и его долности
$('table').on('click', '.btn-position-new-worker', function(){
    //alert('Нажали btn-position-new-worker');
    //console.log($('.position_new_worker'));
    var id = this.id.split('-');
    //console.log(id[4]);
    //console.log($('#new-worker-position-'+id[4]));
    var namePosition = $("#new-worker-span-name_position-"+id[4]).text();
    //console.log(namePosition);
    $("#chek_name_position").text(namePosition);
    var descriptionPosition = $("#new-worker-span-description_position-"+id[4]).text();
    //console.log(descriptionPosition);
    $("#chek_description_position").text(descriptionPosition);
    var created_atPosition = $("#new-worker-td-created_at-"+id[4]).text();
    //console.log(created_atPosition);
    $("#chek_created_at").text(created_atPosition);
    var updated_atPosition = $("#new-worker-td-updated_at-"+id[4]).text();
    //console.log(updated_atPosition);
    $("#chek_updated_at").text(updated_atPosition);
    $("#worker-id_position-ajax").attr('value',id[4]);
    $("#position_selection").css('display', 'none');
    $(".chek_table_position_new_worker").css('display', 'table');
    return false;
});
//обрабатывает кнопку снять выбор должности
$('table').on('click', '.btn-not-chek-position-new-worker', function(){
    //alert('Нажали btn-not-chek-position-new-worker');
    $("#worker-id_position-ajax").attr('value','0');
    $(".chek_table_position_new_worker").css('display', 'none');
    $("#position_selection").css('display', 'block');    
});

//Ссылки сортировки работников для добавления нового работника его начальника
$('a.new_worker_order_ajax_workers').click(function(){
  //alert('Вы нажали на элемент "a" new_worker_order_ajax_workers');
  //console.log(this.id);
  //console.log($('#input_'+this.id).attr('value'));
  var id = this.id;
  $('#span_'+this.id).attr('class',showGlyphicon($('#input_'+this.id).attr('value')))
  $('#input_'+this.id).attr('value',interpreterInput($('#input_'+this.id).attr('value')))
  $('a.new_worker_order_ajax_workers').each(function(i,elem) {
    //console.log(id+" - "+i+": "+elem.id);
    if(id.localeCompare(elem.id)!=0){
        $('#span_'+elem.id).attr('class',"");
        $('#input_'+elem.id).attr('value',"")
    }
  });
  
  var data = $('#my_form_ajax_workers_new_worker').serialize();
  $.ajax({
        url: '/ajaxworkersnewworker',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.new_worker_worker').remove();
            //console.log('Удаление tr сработало');            
            $("table.my_table_workers_new_worker").append(res.msg);
            //console.log('Добовление tr сработало');
            
            $('ul.new_worker_pagination_workers li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.new_worker_pagination_workers").append(res.pg);
            //console.log('Добовление li в pagination сработало');
            
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});

//Пагинатор для выбора начальника для создания работника 3 шаг
$('.new_worker_pagination_workers').on('click', 'a.new_worker_my_page_ajax_workers', function(){
    //alert('Вы нажали на элемент "a" new_worker_my_page_ajax_workers');
    //console.log(this.id);
    $('#new_worker_input_page_ajax').attr('value',this.id);
    var data = $('#my_form_ajax_workers_new_worker').serialize();
    $.ajax({
        url: '/ajaxworkersnewworker',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res); 
            $('tr.new_worker_worker').remove();
            //console.log('Удаление tr сработало');
            $("table.my_table_workers_new_worker").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.new_worker_pagination_workers li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.new_worker_pagination_workers").append(res.pg);
            //console.log('Добовление li в pagination сработало');
            
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
    //return false;
});
//Поиск Начальника для добавления работника на 3 шаге
$("#btn_serch_workers_new_worker").click(function(){
    var data = $('#my_form_ajax_workers_new_worker').serialize();
    $.ajax({
        url: '/ajaxworkersnewworker',
        type: 'POST',
        data: data,
        success: function(res){
            //console.log(res);
            $('tr.new_worker_worker').remove();
            //console.log('Удаление tr сработало');
            $("table.my_table_workers_new_worker").append(res.msg);
            //console.log('Добовление tr сработало');
            $('ul.new_worker_pagination_workers li').remove();
            //console.log('Удаление li pagination сработало');
            $("ul.new_worker_pagination_workers").append(res.pg);
            //console.log('Добовление li в pagination сработало');
        },
        error: function(){
            alert('По неизвестной причине сервер не ответил обратитесь к админу.');
        }
    });
    return false;
});

//обрабатываем кнопку выбрать при добавлении роботника его начальника
$('table').on('click', '.btn-new-worker-workers', function(){
    //alert('Нажали btn-new-worker-workers');
    var id = this.id.split('-');
    //console.log(id[1]);
    var surnameWorkers = $("#new_worker_span-surname-"+id[1]).text();
    //console.log(surnameWorkers);
    $("#new_worker_worker_selection-surname").text(surnameWorkers);
    var nameWorkers = $("#new_worker_span-name-"+id[1]).text();
    //console.log(nameWorkers);
    $("#new_worker_worker_selection-name").text(nameWorkers);
    var patronymicWorkers = $("#new_worker_span-patronymic-"+id[1]).text();
    //console.log(patronymicWorkers);
    $("#new_worker_worker_selection-patronymic").text(patronymicWorkers);
    var positionWorkers = $("#new_worker_worker-position-"+id[1]).text();
    //console.log(positionWorkers);
    $("#new_worker_worker_selection-position").text(positionWorkers);
    var workerWorkers = $("#new_worker_worker-workers-"+id[1]).text();
    //console.log(workerWorkers);
    $("#new_worker_worker_selection-worker_surnamen").text(workerWorkers);
    $("#worker-id_worker-ajax").attr('value',id[1]);
    $("#worker_selection").css('display', 'none');
    $("#teble-selection").css('display', 'block');
    return false;
});
//обрабатывает кнопку снять выбор начальника
$('table').on('click', '.btn-selection-new_worker-worker', function(){
    //alert('Нажали btn-selection-new_worker-worker');
    $("#worker-id_worker-ajax").attr('value','0');
    $("#teble-selection").css('display', 'none');
    $("#worker_selection").css('display', 'block');
    return false;
});

//Обработка home
$('.panel-body').on('dblclick', '.workers', function(){
    //alert('Нажали .workers два раза');
    //console.log(this);
    var id = this.id.split('-');
    //console.log(id);
    //console.log($("#position-"+id[1]));
    var position = Number($("#position-"+id[1]).val());
    if(position == 0){
        var data = $('#form-worker-'+id[1]).serialize();
            //console.log(description_position);
            $.ajax({
                url: '/ajaxhomeworkers',
                type: 'POST',
                data: data,
                success: function(res){
                    if(res[0] == 200){
                        $("#"+id[1]).append(res.msg);
                        $("#position-"+id[1]).attr('value',1);
                        //alert(res['msg']);
                    }else{
                        alert(res['msg']);
                    }
                },
                error: function(){
                    alert('По неизвестной причине сервер не ответил обратитесь к админу.');
                }
            });
        //console.log("Открить работников");
    }else{
        //console.log($(".Chief-"+id[1]));
        $(".Chief-"+id[1]).remove();
        $("#position-"+id[1]).attr('value',0);
        //console.log("Закрыть работников");
    }
    return false;
});
