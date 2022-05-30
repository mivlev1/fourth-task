<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>fourth-task</title>
</head>
<body>
<div class="main">
    <?php
    if ($errorOutput) {
        print('<section id="messages">');
        if ($hasErrors)
            print('<h2>Ошибка</h2>');
        else
            print('<h2>Сообщения</h2>');
        print($errorOutput);
        print('</section>');
    }
    ?>
    <div class="my-form">
        <form action="." method="POST">
            <div class="row mb-3">
                <label for="inputName3" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name-field <?php if (!empty($errors['name'])) {print 'class="error"';} ?>
                           value="<?php print $values['name']; ?>"/">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input class="form-control" name="email-field" <?php if (!empty($errors['email'])) {print 'class="error"';} ?>
                           value="<?php print $values['email']; ?>"
                           type="email" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="Date" class="col-sm-2 col-form-label">Дата</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control"<?php if (!empty($errors['date'])) {print 'class="error"';} ?>
                           value="<?php print $values['date']; ?>"/>
                </div>
            </div>
            <fieldset>
                <label>Пол</label>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio-gender" id="gridRadios1" value="Male" <?php if ($values['gender'] == 'Male') {print 'checked';} ?>/>
                            <label class="form-check-label" for="gridRadios1">
                                Мужчина
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio-gender" id="gridRadios2" value="Female" <?php if ($values['gender'] == 'Female') {print 'checked';} ?> />
                            <label class="form-check-label" for="gridRadios2">
                                Женщина
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <label>Количество конечностей</label>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input id="gridRadios1" class="form-check-input" type="radio" <?php if ($values['limbs'] == '1') {print 'checked';} ?>
                                   name="limbs" value="1" />
                            <label class="form-check-label" for="gridRadios1">
                                Одна
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="gridRadios2" class="form-check-input" type="radio"<?php if ($values['limbs'] == '2') {print 'checked';} ?>
                                   name="limbs" value="2"/>
                            <label class="form-check-label" for="gridRadios2">
                                Две
                            </label>
                        </div>
                        <div class="form-check disabled">
                            <input class="form-check-input" type="radio" id="gridRadios3" <?php if ($values['limbs'] == '3') {print 'checked';} ?>
                                   name="limbs" value="3" />
                            <label class="form-check-label" for="gridRadios3">
                                Три
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <label class="form-check-label">Выберите суперспособность</label>
                    <select class="form-select" name="power[]" multiple>
                        <option value="0" <?php if ($values['power']['0']) {print 'selected';} ?>>Бессмертие</option>
                        <option value="1" <?php if ($values['power']['1']) {print 'selected';} ?>>Левитация</option>
                        <option value="2" <?php if ($values['power']['2']) {print 'selected';} ?>>Сверхсила</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-form-label col-sm-2 pt-0">Пользовательское соглашение</div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="checkz" <?php if ($values['contract']) {print 'checked';} ?>/">
                        <label class="form-check-label" for="gridCheck1" <?php if (array_key_exists('contract', $errors)) {print 'class="error"';} ?>>
                            С условиями согласен
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</body>
</html>