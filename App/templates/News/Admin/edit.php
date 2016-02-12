<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">

    <div class="row">
        <h1 class="col-sm-10">
            <?php if (null == $article->id): ?>
                Добавить
            <?php else: ?>
                Редактировать
            <?php endif; ?>
        </h1>

    </div>

    <form action="/admin/news/save" method="post">

        <input type="hidden" name="id" value="<?php echo $article->id; ?>">

        <?php if (!empty($article->titleAlert)) : ?>
            <div class="alert col-sm-12 alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <?php echo $article->titleAlert; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($article->leadAlert)) : ?>
            <div class="alert col-sm-12 alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <?php echo $article->leadAlert; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($article->textAlert)) : ?>
            <div class="alert col-sm-12 alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <?php echo $article->textAlert; ?>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Заголовок"
                   value="<?php echo $article->title; ?>">
        </div>
        <div class="form-group">
            <label for="published">Время</label>
            <input type="text" class="form-control" id="published" name="published" placeholder="Время"
                   value="<?php echo $article->published; ?>">
        </div>
        <select name="author" class="form-control">
            <?php foreach($authors as $author) : ?>
            <option value="<?php echo $author->id?>" ><?php echo $author->name?></option>
            <?php endforeach; ?>
        </select>
        <div class="form-group">
            <label for="lead">Lead</label>
            <textarea rows="5" class="form-control" id="lead" name="lead"><?php echo $article->lead; ?></textarea>
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea rows="5" class="form-control" id="text" name="text"><?php echo $article->text; ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">
            <?php if (null == $article->id): ?>
                Добавить
            <?php else: ?>
                Редактировать
            <?php endif; ?>
        </button>
        <button type="button" class="btn btn-default" onclick="window.history.back();">Отменить</button>
    </form>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>

</body>
</html>