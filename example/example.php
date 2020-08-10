<?php
require __DIR__ . "/../vendor/autoload.php";

$trigger = new \ElePHPant\Trigger\Trigger();

$trigger->success("Hello World!", "Great!");

$trigger->error("Something's wrong!", "Bad");


var_dump($trigger);

//Unique Error
var_dump($trigger->render());//Debug a only one Object with the Success Message;

//Several Error
var_dump($trigger->render(false));//Debug all errors (success and error);

### METHODS
$trigger->success("Body Message", "Title Message", ["field"], 4000);
$trigger->error("Body Message", "Title Message", ["field"], 4000);
$trigger->warning("Body Message", "Title Message", ["field"], 4000);
$trigger->info("Body Message", "Title Message", ["field"], 4000);

$trigger->fields();// Show all fields
$trigger->render() || $trigger->render(false);//Render the Message(s)
$trigger->messages();//Show Messages
$trigger->titles();//Show Titles
?>