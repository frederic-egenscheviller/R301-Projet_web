<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="/static/styles/main.css">
        <link rel="stylesheet" href="/static/styles/error.css">
        <link rel="stylesheet" href="/static/styles/sign.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/show-three-recipes.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/recipes-show.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/profile.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/appreciation.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/one-recipe.css">
        
        <script type='text/javascript' src='/static/js/add-recipe-form.js'></script>

        <title>Cookeat</title>
    </head>
    <body>
        <?php View::show('standard/header'); ?>
        <?php echo $A_view['body'] ?>
        <?php View::show('standard/footer'); ?>
    </body>
</html>