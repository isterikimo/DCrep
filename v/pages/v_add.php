<? //This file is the property of «Duckcode», Russia?>

<form>
    <div class="add-page">
        <h3> Создание новой страницы </h3>
        <table width="100%">
            <tr>
                <td>
                    <label for="section" title="Выберите раздел для новой страницы">
                        Раздел
                    </label>
                </td>
                <td>
                    <input type="text" name="section" id="section"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="path" title="Введите адрес страницы">
                        Адрес
                    </label>
                </td>
                <td>
                   <input type="text" name="path" id="path"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="title" title="Введите заголовок страницы">
                        Заголовок</b>
                    </label>
                </td>
                <td>
                    <input type="text" name="title" id="title" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="title_in_menu" title="Введите название заголовка">
                        Заголовок в меню
                    </label>
                </td>
                <td>
                    <input type="text" name="title_in_menu" id="title_in_menu" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="keywords" title="Введите ключевые слова для поисковых машин">
                        Ключевые слова
                    </label>
                </td>
                <td>
                    <input type="text" name="keywords" id="keywords" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="description" title="Введите описание страницы для поисковых машин">
                        Описание
                    </label>
                </td>
                <td>
                    <input type="text" name="description" id="description" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="content" title="Введите содержание">
                        Содержание
                    </label>
                </td>
                <td>
                    <textarea name="content" id="content" rows="10" cols="50"></textarea>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <input type="checkbox" name="is_show" id="checkbox" class="checkbox" />
                    <label for="checkbox" title="Выберите для отображения">
                        Отображать на сайте
                    </label>
                </td>
            </tr>
        </table>
        <input type="submit" name="add" class="s-button" value="Добавить" />
    </div>
</form>