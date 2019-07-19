<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Тестовое​ ​задание</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1>Тестовое​ ​задание​ ​на​ ​позицию​ ​Junior​ ​PHP​ ​Developer</h1>
                <ol>
    				<li>Для работы тестового задания необходима сделать миграцию базы данных для этого нужно в консоли запустить команду <bold>php artisan migrate</bold>.</li>
    				<li>Базу данных необходимо заполнить данными для этого используйте консольную команду <bold>php artisan db:seed</bold></li>
    				<li>
    					<h4>Часть​ ​№1​ ​(обязательная)</h4>
    					<p>Создайте веб страницу,которая будет выводить иерархию сотрудников в древовидной​ ​форме.</p> 
    					<ul>
    						<li>
    							Информация о каждом сотруднике должна храниться в базе данных и содержать​ ​следующие​ ​данные:
    							<ul>
    								<li>ФИО;</li>
    								<li>Должность;</li>
    								<li>Дата​ ​приема​ ​на​ ​работу;</li>
    								<li>Размер​ ​заработной​ ​платы;</li>
    							</ul>    						
    						</li>
    						<li>У​ ​каждого​ ​сотрудника​ ​есть​ ​1​ ​начальник;</li>
    						<li>База данных должна содержать неменее 50000 сотрудникови 5 уровней иерархий;</li>
    						<li>Не​ ​забудьте​ ​отобразить​ ​должность​ ​сотрудника.</li>
    					</ul>
    					Ссылка на страницу с моей версией выполнения этого задания - <a href="{{ url('/home') }}" target="_blank">Сотрудники</a><br>
    					Введите  E-Mail Address: mtodzi@gmail.com<br>
						и пароль 123456    				
    				</li>
    				<li>
    					<ul>
    						<li>
    							Создайте еще одну страницу и выведите на ней список сотрудников со всей имеющейся о сотруднике информацией из базыданных и возможностью сортировать​ ​по​ ​любому​ ​полю.   						
    						</li>
    						<li>Добавьте возможность поиска сотрудников полюбому полю для страницы 	созданной​</li>
    						<li>В разделе доступном только для зарегистрированных пользователей, реализуйте остальные CRUD операции 
    							для записей сотрудников. Пожалуйста заметьте, что все поля касающиеся пользователей должны быть редактируемыми,​ ​включая​ ​начальника​ ​каждого​ ​сотрудника</li>
    						<li>Осуществите возможность загружать фотографию сотрудника и отобразите ее настранице,
    							где можно редактировать данные о сотрудник. Добавьте дополнительную колонку с уменьшенной фотографией сотрудника на странице​ ​списка​ ​всех​ ​сотрудников</li>
    					</ul>
    					
    					Ссылка на страницу с моей версией выполнения этого задания - <a href="{{ url('/workers') }}" target="_blank">Сотрудники таблица</a><br>
    				</li>
    				<li>Тоже что и 4 пункт только без перезагрузки страницы - <a href="{{ url('/ajaxworkers') }}" target="_blank">Сотрудники таблица</a></li>
  				</ol>                                  
            </div>
        </div>
    </body>
</html>
