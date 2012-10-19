<?php
        $config = new Zend_Config(
                        array(
                            'database' => array(
                                'adapter' => 'Mysqli',
                                'params' => array(
                                    'dbname' => 'dbalhambra',
                                    'username' => 'root',
                                    'password' => 'hesleither',
                                )
                            )
                        )
        );
        $db = Zend_Db::factory($config->database);
?>