## BasicCRM

Basic CRM like app build with Laravel with no enhanced UI (out of the box Laravel).

Features: 
-Admin is able to create clients

-* is able to create Orders and link them with client

    -- when an order is created a Contract is automatically created as well and linked with Client and Order
    
-ability to edit Order and add multiple tags to it.

-when Order is deleted the Contracts is cancelled as well

-when Client is deleted associated Orders and Contracts are deleted as wel.

-every deleted entity is reversible.
