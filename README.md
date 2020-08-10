# Trigger @ElePHPant

[![Maintainer](http://img.shields.io/badge/maintainer-@sergiodanilojr-blue.svg?style=flat-square)](https://twitter.com/sergiodanilojr)
[![Source Code](http://img.shields.io/badge/source-elephpant/trigger-blue.svg?style=flat-square)](https://github.com/sergiodanilojr/trigger)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/elephpant/trigger.svg?style=flat-square)](https://packagist.org/packages/elephpant/trigger)
[![Latest Version](https://img.shields.io/github/release/elephpant/trigger.svg?style=flat-square)](https://github.com/sergiodanilojr/trigger/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/sergiodanilojr/trigger.svg?style=flat-square)](https://scrutinizer-ci.com/g/sergiodanilojr/trigger)
[![Quality Score](https://img.shields.io/scrutinizer/g/sergiodanilojr/trigger.svg?style=flat-square)](https://scrutinizer-ci.com/g/sergiodanilojr/trigger)
[![Total Downloads](https://img.shields.io/packagist/dt/elephpant/trigger.svg?style=flat-square)](https://packagist.org/packages/elephpant/trigger)

###### Trigger is the absurdly easy way to communicate with the user of your application through highly customizable messages.

Trigger é a maneira absurdamente fácil de comunicar com o usuário da sua aplicação por meio de mensagens altamente personalizáveis.


### Highlights

- Extremaly Easy
- Flexible
- It's possible bring message for the view Interface 
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)

## Installation

Quotation is available via Composer:

```bash
"elephpant/trigger": "*"
```

or run

```bash
composer require elephpant/trigger
```

## Documentation

###### For details on how to use, see a sample folder in the component directory. In it you will have an example of use for this component. It works like this:

Para mais detalhes sobre como usar, veja uma pasta de exemplo (example) no diretório do componente. Nela terá exemplo de uso do componente. Ele funciona assim:


#### It's simple.

```php
<?php
require __DIR__ . "/vendor/autoload.php";

use \ElePHPant\Trigger\Trigger;

//Like you can see down, it's possible receive four params
// 1 - Message Body, where you'ill put the own message to explicit for the member.
// 2 - Title (optional param) for you insert the title of message.
// 3 - You can record the field (optional param) of form for show for your member some message about those field.
// 4 - Normally plugins that you can utilize there's a time to show message in the screen, then you can define a default Timeout (default's 5000 miliseconds)

$trigger = new Trigger();
$trigger->success("Body of Message", "Title of Message", ["field_of_form"],3000);


```

#### Types

```php
<?php
require __DIR__ . "/vendor/autoload.php";

use \ElePHPant\Trigger\Trigger;
$trigger = new Trigger();

// There're 4 types trigger:

//::SUCCESS::
$trigger->success("A new member was added with Success", "Great!", null);

//::ERROR::
$trigger->error("Insert a valid e-mail!", "Whoopss", ["email"]);

//::WARNING::
$trigger->warning("Your password is so short!","Cation!",["password"]);

//::INFO::
$trigger->info("You need complete your profile!","Info!");
```


#### Sigle Error or Several Errors

```php
<?php
require __DIR__ . "/vendor/autoload.php";

use \ElePHPant\Trigger\Trigger;
$trigger = new Trigger();

// For default You can only show a unique error;
// But you can set a option to show several errors that your record in the Trigger Object
// For that You will change the uption Unique in the RENDER METHOD

//::SUCCESS:: UNIQUE
$trigger->success("A new member was added with Success", "Great!", null)->render();


//::ERROR:: SEVERAL ERRORS THAT YOU HAVE
$trigger->error("Your e-mail is invalid", "Bad!", ["email"]);
$trigger->error("Your password must have minimum 8 characters", "Bad!", ["password"]);
$trigger->render(false); //Here you Will have two errors for you show in the View for your User.

```

#### Heritage and Polimorphism

```php
<?php
// You can abstract the behavior of the component like that

namespace MyApp;
use ElePHPant\Trigger\Trigger;

class Message extends Trigger
{
    public function danger(string $message, ?string $title = null, ?array $fields = null, int $timeOut = 5000):self
    {
            $this->setTrigger(__FUNCTION__, $message, $title, $fields, $timeOut);
            return $this;
    }
}

// And voilà, you have a new method, with another name, and you can do whatever. This is possible because this component was thought for implement in any project.

```


#### Do the Trigger talk with your JavaScript

```php
<?php
//You can send throw the Controller a response in json and your js can read and do anything

//From controller: 

echo json_encode(['response'=>$trigger->success('You need insert a valid e-mail!')->render()]);

```
```js
//With JS (I'll utilize the jQuery Library for example) you can:
$(function(){
    $('form').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var action = form.attr('action');

        $.post(action, function(response){
        
            if(response.message){
                var field = form.find("[name="+response.field+"]");
                field.addClass('is-invalid');
                field.parents('.form-group').append(`<div class="invalid-feedback">${response.message}</div>`);
            }
        }, 'json');
    });
});
```



## Contributing

Please see [CONTRIBUTING](https://github.com/sergiodanilojr/trigger/blob/master/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email sergiodanilojr@hotmail.com instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para sergiodanilojr@hotmail.com em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Sérgio Danilo Jr.](https://github.com/sergiodanilojr) (Developer)
- [All Contributors](https://github.com/sergiodanilojr/trigger/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/sergiodanilojr/trigger/blob/master/LICENSE) for more information.