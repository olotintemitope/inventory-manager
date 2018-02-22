[![Build Status](https://travis-ci.org/andela-tolotin/inventory-manager.svg?branch=master)](https://travis-ci.org/andela-tolotin/inventory-manager)

## About Inventory Manager

This is an Inventory management for POS(point of sales) using PHP/Laravel for building a RESTful API that will help shop owners to manage their inventory.

## Api Documentation
- https://documenter.getpostman.com/view/3781859/inventory-manager/RVg28T5R#e7a12353-77c0-5922-dead-93e28666f0c4

### Resources

## User

A simple registration phase to submit payload(username, email) via a POST request

- Can be created
- Can be updated
- Can be disapprove

A token is return back to the user to make subsequent calls

## Business
A user can have one or more businesses to manage

## Inventory Category
Inventory categories allows the user to categorize their items

- Can be created
- Can be updated
- Cannot be deleted because they might be tied to sales already

## Inventory Items 
This belongs to a particular category

- Can be created
- Can be updated
- Cannot be deleted because they might be tied to sales already

## Reports

This is a get request where user can get overview on inventory sales

- User can get reports between date intervals

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
