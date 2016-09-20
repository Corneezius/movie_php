<?php
    require_once "src/Movie.php";

    /**
    * @backupGlobals disabled
    * #backupStaticAttributes disabled
    */

    $server = 'mysql:host=localhost:8889;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class test_Movie extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Movie::deleteAll();
        }

        function test_save()
        {
            // Arrange
            $name = "Star Wars IV: A New Hope";
            $genre = "action/adventure";
            $test_movie = new Movie($name, $genre);

            // Act
            $test_movie->save();

            // Assert
            $result = Movie::getAll();
            $this->assertEquals($test_movie, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Star Wars IV: A New Hope";
            $genre = "action/adventure";
            $test_movie = new Movie($name, $genre);
            $test_movie->save();
            $name2 = "Lord of the Rings: The Fellowship of the Ring";
            $genre2 = "action/adventure";
            $test_movie2 = new Movie($name2, $genre2);
            $test_movie2->save();

            // Act
            $result = Movie::getAll();

            // Assert
            $this->assertEquals([$test_movie, $test_movie2], $result);
        }

        function getId()
        {
            // Arrange
            $name = "Star Wars IV: A New Hope";
            $genre = "action/adventure";
            $id = 1;
            $test_movie = new Movie($name, $genre, $id);

            // Act
            $result = $test_movie->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function test_find()
        {
            // Arrange
            $name = "Star Wars IV: A New Hope";
            $genre = "action/adventure";
            $test_movie = new Movie($name, $genre);
            $test_movie->save();
            $name2 = "Lord of the Rings: The Fellowship of the Ring";
            $genre2 = "action/adventure";
            $test_movie2 = new Movie($name2, $genre2);
            $test_movie2->save();

            // Act
            $id = $test_movie->getId();
            $result = Movie::find($id);

            // Assert
            $this->assertEquals($test_movie, $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "Star Wars IV: A New Hope";
            $genre = "action/adventure";
            $test_movie = new Movie($name, $genre);
            $test_movie->save();
            $name2 = "Lord of the Rings: The Fellowship of the Ring";
            $genre2 = "action/adventure";
            $test_movie2 = new Movie($name2, $genre2);
            $test_movie2->save();

            // Act
            Movie::deleteAll();

            // Assert
            $result->assertEquals([], $result);
        }
    }
 ?>
