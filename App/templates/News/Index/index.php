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

        </div>
        <br>
        <br>

        <div class="row">

            <?php foreach ($articles as $article): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $article->published; ?><br>
                        <?php if (!empty($article->author)) : ?>
                            <?php echo $article->author->name; ?>
                        <?php endif; ?>

                        <a href="/news/one?id=<?php echo $article->id; ?>"><h3>
                                <?php echo $article->title; ?>
                            </h3></a>
                        <br>
                        <?php echo $article->lead; ?>
                    </div>


                </div>
            <?php endforeach; ?>
        </div>


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