# EAP: Architecture Specification and Prototype

## A7: Web Resources Specification
Project modules are identified and briefly described to organize how they are presented in the yaml document.

### 1. Overview

| Module | Description |
| --- | --- |
| **M01: Authentication and Individual Profile** | Web resources associated with user authentication and individual profile management. Includes the following system features: login/logout, registration, credential recovery, view and edit personal profile information. |
| **M02: Products** | Web resource associated with the search and listing of the products available to the user. |
| **M03: Reviews and Wishlist** | Web resources associated with reviews and wishlist. Includes the following system features: view review, add reviews, edit reviews and delete reviews; add items to wish list and remove items from the wish list. |
| **M04: Cart** | Web resources associated with the management of the cart. |
| **M05: Static pages** | Static pages like: about us, main features and contacts. |
| **M06: Management Area** | Web resources associated with website management, specifically: view and edit purchases, view, edit, add and delete properties, view, edit, add and delete categories and view, add and delete faqs. |

### 2. Permissions

|  |  |  |
| -- | -- | -- |
| **PUB** | Public | Users without privileges |
| **USR** | User | Authenticated users |
| **OWN** | Owner | User that are owners of the information |
| **ADM** | Administrator | System administrators |

### 3. OpenAPI Specification

This section includes the [GameSpace OpenAPI](https://git.fe.up.pt/lbaw/lbaw2324/lbaw23154/-/blob/main/documents/a7_openapi.yaml?ref_type=heads).


```yaml
openapi: 3.0.0

info:
  version: '1.1'
  title: 'LBAW GameSpace Web API'
  description: 'Web Resources Specification (A7) for GameSpace'

servers:
  - url: http://lbaw.fe.up.pt
    description: Production server

externalDocs:
 description: Find more info here.
 url: https://web.fe.up.pt/~ssn/wiki/teach/lbaw/medialib/a07

tags:
  - name: 'M01: Authentication and Individual Profile'
  - name: 'M02: Products'
  - name: 'M03: Reviews and Wishlist'
  - name: 'M04: Cart'
  - name: 'M05: Static Pages'
  - name: 'M06: Management Area'

paths:
  /login:
    get:
      operationId: R101
      summary: "R101: Login Form"
      description: "Provide form for authentication. Access: PUB"
      tags:
        - "M01: Authentication and Individual Profile"
      responses:
        "200":
          description: "Ok."

  /users/authenticate:
    post:
      operationId: R102
      summary: 'R102: Login Action'
      description: 'Processes the login form submission. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
                  format: email
                password:
                  type: string
                  format: password
              required:
                - email
                - password

      responses:
        "302":
          description: "Redirect after processing the login credentials."
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Successful login. Redirect to homepage."
                  value: "/"
                302Admin:
                  description: 'Successful authentication. Redirect to admin dashboard.'
                  value: '/dashboard'
                302Failure:
                  description: "Failed login. Redirect to login form."
                  value: "/login"

  /logout:
    post:
      operationId: R103
      summary: 'R103: Logout Action'
      description: 'Logout the current authenticated user. Access: USR, ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to Homepage'
                  value: '/'

  /register:
    get:
      operationId: R104
      summary: 'R104: Register Form'
      description: 'Provide new user registration form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok.'

    post:
      operationId: R105
      summary: 'R105: Register Action'
      description: 'Processes the new user registration form submission. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          multipart/form-data:
            schema:
              type: object
              properties:
                name:
                  type: string
                phone_number:
                  type: integer
                email:
                  type: string
                  format: email
                password:
                  type: string
                  format: password
                confirm_password:
                  type: string
                  format: password
              required:
                - name
                - phone_number
                - email
                - password
                - confirm_password

      responses:
        "302":
          description: "Redirect after processing the new user sign-up form."
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Successful registration. Redirect to home page."
                  value: "/"
                302Failure:
                  description: "Failed registration. Redirect to sign-up form."
                  value: "/register"

  /users/{user}:
    get:
      operationId: R106
      summary: 'R106: View User Profile'
      description: 'Page that shows user information and purchase history. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      parameters:
        - in: path
          name: user
          schema:
            type: int
          description: 'Specifies the member user ID'
          required: true
      responses:
        '200':
          description: 'Ok.'
        '404':
          description: 'User not found.'

  /users/edit:
    get:
      operationId: R107
      summary: 'R107: Edit User profile page'
      description: 'Page that allows a user to update his information. Access: OWN'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok.'
        '403':
          description: 'Forbidden access'

    put:
      operationId: R108
      summary: 'R108: Edit User profile action'
      description: 'Allows a user to edit his information. Access: OWN'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                email:
                  type: string
                phone_number:
                  type: string
                image:
                  type: file
              required:
                - name
                - email
                - phone_number
                - image
      responses:
        '302':
          description: 'Redirect member after editing profile.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Member information edited successfully. Redirects member to their profile page.'
                  value: '/users/{user}'
                302Failure:
                  description: 'Member information editing failed. Stay in edit page.'
                  value: '/users/edit'
        '403':
          description: 'Forbidden access'

  /users:
    delete:
      operationId: R109
      summary: 'R109: Soft Delete Account'
      description: 'Delete a User. Access: OWN'

      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful user deletion. Redirect to Homepage'
                  value: '/'

  /addresses:
    post:
      operationId: R110
      summary: 'R110: Save Address In Profile'
      description: 'Processes the Add Address form submission. Access: OWN'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                label:
                  type: string
                street:
                  type: string
                city:
                  type: string
                postal_code:
                  type: string
              required:
                - label
                - street
                - city
                - postal_code

      responses:
        "302":
          description: "Redirect after processing the added address."
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Successfully added address. Redirect to member profile page."
                  value: "/users/{user}"
                302Failure:
                  description: "Failed to add address. Redirect to member profile page."
                  value: "/users/{user}"

  /adresses/{address}:
    put:
      operationId: R111
      summary: 'R111: Update Address In Profile'
      description: 'Allows a user to edit his address. Access: OWN'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                label:
                  type: string
                street:
                  type: string
                city:
                  type: string
                postal_code:
                  type: string
              required:
                - label
                - street
                - city
                - postal_code
      responses:
        '302':
          description: 'Redirect member after editing profile.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Member information edited successfully. Redirects member to their profile page.'
                  value: '/users/{user}'
                302Failure:
                  description: 'Member information editing failed. Redirects member to their profile page.'
                  value: '/users/{user}'
        '400':
          description: 'Bad Request'
        '403':
          description: 'Forbidden access'

    delete:
      operationId: R112
      summary: 'R112: Remove Address In Profile'
      description: 'Delete an Address. Access: OWN'
      tags:
        - 'M01: Authentication and Individual Profile'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: string
      responses:
        '302':
          description: 'Successful address deletion. Redirect to member profile page'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful address deletion. Redirect to member profile page'
                  value: '/users/{user}'
        '400':
          description: 'Bad Request'
        '403':
          description: 'Forbidden access'

    /login:
      get:
        operationId: R101
        summary: "R101: Login Form"
        description: "Provide form for authentication. Access: PUB"
        tags:
          - "M01: Authentication and Individual Profile"
        responses:
          "200":
            description: "Ok."

  /:
    get:
      operationId: R201
      summary: 'R201: View All Products'
      description: 'Home Page, displays product list. Access: PUB'
      tags:
        - 'M02: Products'
      responses:
        '200':
          description: 'Ok.'

  /products/{product}:
    get:
      operationId: R202
      summary: 'R202: View Product'
      description: "Shows the page of a product and its reviews. Access: PUB"
      tags:
        - 'M02: Products'
      parameters:
        - in: path
          name: product
          schema:
            type: integer
          required: true
          description: 'Specifies the id of the product'
      responses:
        '200':
          description: 'Ok.'
        '404':
          description: 'Product not found'

  /?search={text}:
    get:
      operationId: R203
      summary: 'R203: Search Products'
      description: 'Shows the search results of the input string. Access: PUB'
      tags:
        - 'M02: Products'
      parameters:
        - in: path
          name: text
          schema:
            type: string
          description: 'Specifies the input string to run the search on'
          required: true
      responses:
        '200':
          description: 'Ok.'

  /?category={category}:
    get:
      operationId: R204
      summary: 'R204: Filter by Category'
      description: 'Shows the products of a given category. Access: PUB'
      tags:
        - 'M02: Products'
      parameters:
        - in: path
          name: category
          schema:
            type: string
          description: 'Specifies the category of which products are shown'
          required: true
      responses:
        '200':
          description: 'Ok.'
        '404':
          description: 'Product not found'

  ########## Reviews and Wishlist ##########

  /reviews:
    post:
      operationId: R301
      summary: 'R301: Review a game'
      description: 'Adds a review to a game. Access: USR'
      tags:
        - 'M03: Reviews and Wishlist'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                product_id:
                  type: integer
                score:
                  type: integer
                comment:
                  type: string
              required:
                - product_id
                - score
                - comment
      responses:
        '200':
          description: 'Ok.'
        '403':
          description: 'Forbidden access'

  /reviews/{review}:
    delete:
      operationId: R302
      summary: 'R302: Delete a game review'
      description: "Deletes a specified review. Access: OWN"
      tags:
        - 'M03: Reviews and Wishlist'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              properties:
                user_id:
                  type: integer
                review:
                  type: integer
              required:
                - user_id
                - review
      responses:
        '200':
          description: 'Ok.'
        '403':
          description: 'Forbidden access'
        '404':
          description: 'Not Found'

  /wishlist:
    get:
      operationId: R303
      summary: 'R303: View Wishlist'
      description: "Shows the user's wishlist. Access: OWN"
      tags:
        - 'M03: Reviews and Wishlist'
      responses:
        '200':
          description: 'Ok.'
        '403':
          description: 'Forbidden access'

  /wishlist/{product}:
    post:
      operationId: R304
      summary: 'R304: Add Product to Wishlist'
      description: 'Adds a product to the wishlist. Access: OWN'
      tags:
        - 'M03: Reviews and Wishlist'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                user_id:
                  type: integer
                product_id:
                  type: integer
              required:
                - user_id
                - product_id
      responses:
        '200':
          description: 'Ok.'
        '403':
          description: 'Forbidden access'
        '404':
          description: 'Not Found'

    delete:
      operationId: R305
      summary: 'R305: Remove Product from Wishlist'
      description: "Removes a specified product from the user's wishlist. Access: OWN"
      tags:
        - 'M03: Reviews and Wishlist'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              properties:
                user_id:
                  type: integer
                product_id:
                  type: integer
              required:
                - user_id
                - product_id
      responses:
        '200':
          description: 'Ok.'
        '403':
          description: 'Forbidden access'
        '404':
          description: 'Not Found'

  ########## CART ##########
  /cart:
    get:
      operationId: R401
      summary: 'R401: View Shopping Cart'
      description: 'Display the user`s cart. Access: OWN'
      tags:
       - 'M04: Cart'

      responses:
        '200':
          description: "Ok."

    delete:
      operationId: R404
      summary: 'R404: Clear Cart'
      description: 'Delete the user`s cart. Access: OWN'
      tags:
        - 'M04: Cart'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              properties:
                id_user:
                  type: integer
              required:
                - user_id

      responses:
        '200':
          description: "Ok."
        '403':
          description: "Error. Forbidden"

  /cart/{product}:
    post:
      operationId: R402
      summary: 'R402: Add to Shopping Cart'
      description: 'Add a product to the user`s cart. Access: OWN'
      tags:
        - 'M04: Cart'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                user_id:
                  type: integer
                product_id:
                  type: integer
              required:
                - user_id
                - product_id
      responses:
        '200':
          description: 'Ok. Added product successfully'
        '403':
          description: 'Error. Forbidden'
        '404':
          description: 'Error. Not Found'

    delete:
      operationId: R403
      summary: 'R403: Remove from Shopping Cart'
      description: 'Remove a product from the user`s cart. Access: OWN'
      tags:
        - 'M04: Cart'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              properties:
                product_id:
                  type: integer
                user_id:
                  type: integer
              required:
                - product_id
                - user_id
      responses:
        '200':
          description: 'Ok.'
        '403':
          description: 'Error. Forbidden'
        '404':
          description: 'Error. Not Found'

    patch:
      operationId: R405
      summary: 'R405: Update Cart'
      description: 'Update the amount of a product in user`s cart. Access: OWN'
      tags:
        - 'M04: Cart'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                user_id:
                  type: integer
                product_id:
                  type: integer
                quantity:
                  type: integer
              required:
                - user_id
                - product_id
                - quantity
      responses:
        '200':
          description: "Ok. Cart updated successfully"
        '403':
          description: "Error. Forbidden"
        '404':
          description: "Error. Not Found"

  /checkout:
    post:
      operationId: R406
      summary: 'R406: Checkout Items in Cart'
      description: 'Make a purchase, clearing the cart. Access: OWN'
      tags:
        - 'M04: Cart'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
            properties:
              user_id:
                type: integer
              product_id:
                type: integer
            required:
              - user_id
              - product_id
    responses:
      '200':
        description: "Ok. Added product successfully"
      '400':
        description: "Error. Bad Request"
      '404':
        description: "Error. Not Found"

```

---


## A8: Vertical prototype

The Vertical Prototype incorporates the implementation of features identified as essential in the common and theme requirement documents. With this information, we have realized all user stories prioritized as high, as detailed in the sections below.
The primary purpose of this artifact is to validate the presented architecture and provide us with foundational insights into the technologies employed in the project.
In adherence to best practices, the implementation is grounded in the code of the LBAW Framework, involving comprehensive work across all layers of the solution's architecture. The prototype encompasses the realization of page visualizations (such as home, profile, product, cart, wishlist and search pages), content manipulation operations (insertion, editing, and removal of addresses), and the incorporation of various error and success messages.

### 1. Implemented Features

#### 1.1. Implemented User Stories

For the vertical prototype we decided to implement all of the user stories that had priority set to high.

| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US01 | Product Details | High | As a User, I want to be able to see the product details, so that I can see a detailed representation of it. |
| US02 | Search products | High | As a User, I want to be able to search for products, so that I can find what I'm looking for. |
| US14 | Sign-in | High | As a Visitor, I want to be able to authenticate into the system, so that I can access privileged information. |
| US15 | Sign-up | High | As a Visitor, I want to be able to register myself into the system, so that I can authenticate myself into the system. |
| US19 | Add to Shopping Cart | High | As an Authenticated User, I want to be able to add products to the shopping cart, so that I can buy them later. |
| US20 | Manage Shopping Cart | High | As an Authenticated User, I want to be able to manage my shopping cart, so that I can decide what I want to buy. |
| US21 | Log out | High | As an Authenticated User, I want to be able to log in and out of my account, so that I can protect my personal information and ensure no unauthorized access to my account. |
| US22 | View profile | High | As an Authenticated User, I want to be able to view my profile, so that I can see my personal data |
| US23 | Edit profile | High | As an Authenticated User, I want to be able to edit my profile, so I can alter my personal data |
| US24 | Delete account | High | As an Authenticated User, I want to be able to delete my account, so that I can remove my personal data from the site when I don’t want to use it anymore |
| US42 | Review a game | High | As a Buyer, I want to be able to write a review of a game that I have bought, so that other users can see what I thought of the game. |
| US43 | Give games a score | High | As a Buyer, I want to be able to rate a game from 1 to 5, so that other users have an idea of the quality of the game. |
| US44 | Delete a game score | High | As a Buyer, I want to be able to  delete the score I’ve given to a game, so that other users don’t see it. |
| US45 | Check purchase history | High | As a Buyer, I want to be able to view my purchase history, so that I can check my past purchases. |
| US46 | Delete a game review | High | As a Buyer, I want to be able to  delete a previous review I wrote about a game, so that other users can't read it. |

<figcaption>Table: vertical prototype implemented user stories </figcaption>

#### 1.2. Implemented Web Resources

#### Module M01: Authentication and Individual Profile 

| Web Resource Reference         | URL                            |
| ------------------------------ | ------------------------------ |
| R101: Login Form	             | GET /login                     |
| R102: Login Action	        | POST /users/authenticate       |
| R103: Logout Action            | POST /logout                   | 
| R104: Register Form            | GET /register                  | 
| R105: Register Action	        | POST /register                 |
| R106: View User profile        | GET /users/{user}              |
| R107: Edit User profile page   | GET /users/edit                |
| R108: Edit User profile action | PUT /users/edit                |
| R109: Soft Delete Account	   | DELETE /users                  |
| R110: Save Address In Profile  | POST /addresses                |
| R111: Update Address In Profile| PUT /addresses/{address}       |
| R112: Remove Address In Profile| DELETE /addresses/{address}    |

<figcaption>Table: authentication and profile's implementation </figcaption>

#### M02: Products

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R201: View All Products | GET / |
| R202: View Product | GET /products/{product} |
| R203: Search Products | GET /?search={text} |
| R204: Filter By Category | GET /?category={category} |


<figcaption>Table: products' implementation </figcaption>

#### M03: Reviews and Wishlist

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R301: Review a game | POST /reviews |
| R302: Delete a game review | DELETE /reviews/{review} |
| R303: View Wishlist | GET /wishlist |
| R304: Add Product to Wishlist | POST /wishlist/{product} |
| R305: Remove Product from Wishlist | DELETE /wishlist/{product} |

<figcaption>Table: game reviews and wishlist's implementation </figcaption>

#### M04: Cart

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R401: View Shopping Cart | GET /cart |
| R402: Add to Shopping Cart | POST /cart/{product} |
| R403: Remove from Shopping Cart | DELETE /cart/{product} |
| R404: Clear Cart | DELETE /cart |
| R405: Update Cart | PATCH /cart/{product} |
| R406: Checkout Items in Cart | POST /checkout |

<figcaption>Table: cart's implementation </figcaption>


### 2. Prototype

For this prototype we focused our efforts in developing the main functionalities of the project. We applied some time on the visual aspect but the design might still have some bugs. Apart from this, it might be easy enough to get an idea of the general layout and easily navigate through the website.

The prototype is available at http://lbaw23154.lbaw.fe.up.pt

# Credentials:
- user: test@test.com
- password: password

The code is available at https://git.fe.up.pt/lbaw/lbaw2324/lbaw23154

## Revision History

## GROUP23154, 23/11/2023

* Group member 1 João Brandão Alves, up202108670@fe.up.pt 
* Group member 2 Eduardo Machado Teixeira de Sousa, up202103342@fe.up.pt (Editor)
* Group member 3 Gonçalo Carvalho Marques, up202006874@fe.up.pt
* Group member 4 Carlos Daniel Santos Reis, up201805156@fc.up.pt 
