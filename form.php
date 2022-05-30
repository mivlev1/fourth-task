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
    <section id="form">
        <form action="."
              method="POST">
            <label>
                Имя<br />
                <input name="name" <?php if (!empty($errors['name'])) {print 'class="error"';} ?>
                       value="<?php print $values['name']; ?>"/>
            </label><br />
            <div class="row mb-3">
                <label for="inputName3" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10">
                    <input name="name" <?php if (!empty($errors['name'])) {print 'class="error"';} ?>
                           value="<?php print $values['name']; ?>"/>
                </div>
            </div>

            <label>
                E-mail:<br />
                <input name="email" <?php if (!empty($errors['email'])) {print 'class="error"';} ?>
                       value="<?php print $values['email']; ?>"
                       type="email" />
            </label><br />

            <label>
                Дата рождения:<br />
                <input name="date" <?php if (!empty($errors['date'])) {print 'class="error"';} ?>
                       value="<?php print $values['date']; ?>"
                       type="date" />
            </label><br />

            Пол:<br />
            <label><input type="radio"
                          name="gender" value="Male" <?php if ($values['gender'] == 'Male') {print 'checked';} ?>/>
                мужской
            </label>
            <label><input type="radio"
                          name="gender" value="Female" <?php if ($values['gender'] == 'Female') {print 'checked';} ?> />
                женский
            </label>
            <br />

            Количество конечностей:<br />
            <label><input type="radio" <?php if ($values['limbs'] == '1') {print 'checked';} ?>
                          name="limbs" value="1" />
                1
            </label>
            <label><input type="radio" <?php if ($values['limbs'] == '2') {print 'checked';} ?>
                          name="limbs" value="2" />
                2
            </label>
            <label><input type="radio" <?php if ($values['limbs'] == '3') {print 'checked';} ?>
                          name="limbs" value="3" />
                3
            </label>
            <br />

            <label>
                Сверхспособности:
                <br />
                <select name="power[]"
                        multiple="multiple">
                    <option value="0" <?php if ($values['power']['0']) {print 'selected';} ?>>Бессмертие</option>
                    <option value="1" <?php if ($values['power']['1']) {print 'selected';} ?>>Прохождение сквозь стены</option>
                    <option value="2" <?php if ($values['power']['2']) {print 'selected';} ?>>Левитация</option>
                </select>
            </label><br />
            <br />
            <label <?php if (array_key_exists('contract', $errors)) {print 'class="error"';} ?>>
                <input type="checkbox"
                       name="contract" <?php if ($values['contract']) {print 'checked';} ?>/>
                С условиями ознакомлен
            </label><br />

            <input id="submit" type="submit" value="Отправить" />
        </form>
    </section>
</div>
</body>
</html>