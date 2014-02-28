<?php echo $this->Facebook->html(); ?>
    <head>
        <title><?php echo $title_for_layout ?></title>
    </head>
    <body>
        <?php echo $this->Facebook->login(array('perms' => 'email')); ?>
        <?php echo $this->Facebook->registration(array(
		    'fields' => 'name,gender,location,email,age_renge, username, link, last_name, fist_name, id',
		    'width' => 600,
		    'redirect-uri' => 'http://localhost/nfchurch'
		)); ?>

    </body>
    <?php echo $this->Facebook->init(); ?>
</html>