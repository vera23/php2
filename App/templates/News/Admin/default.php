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
<div class="container">
    <section>
        <div class="row">
            <div class="col-sm-12 text-center"><h1>Новости</h1>
            </div>

            <div class="col-sm-12">
                <a href="/admin/news/edit?id=new" role="button" class="btn btn-success pull-right">
                    Добавить новость
                </a>
            </div>

        </div>
        <br>
        <br>
        <table class="table col-sm-12">

            <?php foreach ($articles as $article): ?>
                <tr>
                    <td class="col-sm-10">
                        <?php echo $article->published; ?><br>
                        <?php if (!empty($article->author)) : ?>
                            <?php echo $article->author->name; ?>
                        <?php endif; ?>
                        <a href="/admin/news/edit?id=<?php echo $article->id; ?>"><h3>
                                <?php echo $article->title; ?>
                            </h3></a>
                        <br>
                        <?php echo $article->lead; ?>
                    </td>
                    <td class="col-sm-2">
                        <a href="/admin/news/edit?id=<?php echo $article->id; ?>" role="button" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <a href="delete.php?id=<?php echo $article->id; ?>&delete=true" role="button"
                           class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </table>

    </section>
</div>
<!-- <jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>

</body>
</html>