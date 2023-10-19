# Project Name: Event Organizer Toolkit (Under Construction)
Event Organizer Toolkit is an in-progress WordPress plugin that provides REST API endpoints for managing accommodations and an accommodation admin user interface for listing, adding, editing, and deleting accommodations. Please note that this project is currently under construction and should be used with caution, preferably in a local development environment.

The aim of the project is to develop a WordPress plugin that serves as a tool for event organizers to create accommodation and dining lists for registered participants, as well as generate name tags and meal tickets.

## Features
REST API endpoints for accommodations management.
Accommodation admin UI for listing, adding, editing, and deleting accommodations.

## Caution
This project is currently under construction and may contain bugs or incomplete features. While the REST API endpoints do support authentication, queries are not restricted by capabilities, so exercise caution when testing the plugin.

For safety reasons, it's recommended to test the plugin only locally in a development environment. Additionally, be sure to back up your data before using this plugin in any live WordPress installation.

Please note that this README serves as an initial guide and will be updated as the project progresses and new features are added."

This updated caution section reflects the use of authentication for REST API endpoints and emphasizes the importance of testing and data backup for safe usage.

## Installation 

Clone this repository using the following command, which will create an "event-organizer-toolkit" directory within the "plugins" directory of your WordPress installation:

```bash
git clone https://github.com/jaseppan/event-organizer-toolkit.git
```
After cloning, activate the plugin.

## Usage
### Accommodations admin user interface

You can test the listing, adding, editing, and deleting of accommodations within the WordPress admin view by following these steps:

1. Navigate to "Event Organizer Toolkit" in the WordPress admin menu.
2. Select submenu "Accommodations."

You'll find a page with tabs labeled "List Accommodations" and "Add New Accommodation."

### REST API Endpoints

**Testing with python module**

Before diving into the endpoints, if you are looking for a way to automate testing these endpoints, consider using the rest_test module. It provides functionalities to test REST API endpoints and also helps in generating random test data, making the testing process efficient and comprehensive.

**Using rest_test to Test Endpoints**

Add Accommodation Endpoint Test:

```python
from rest_test import test_api_endpoint

url = "{{hostname}}/wp-json/event-organizer-toolkit/v1/add-accommodation"
method = "POST"
parameters = {
    "title": "Accommodation",
    "description": "Lorem ipsum...",
    "rooms": ["room 1", "room 2"]
}
responses = test_api_endpoint(url, method, parameters)
```

Generating fake data:

```python
url = "{{hostname}}/wp-json/event-organizer-toolkit/v1/add-accommodation"
method = "POST"
parameters = {
   "title":"%word",
   "description":"%text",
   "rooms":[
      "%word",
      "%word"
   ]
}
iterations = 10
responses = test_api_endpoint(url, method, parameters, iterations)
```

Testing CRUD Operations:

```python
create_url = "{{hostname}}/wp-json/event-organizer-toolkit/v1/add-accommodation"
read_url = "{{hostname}}/wp-json/event-organizer-toolkit/v1/get-accommodation"
update_url = "{{hostname}}/wp-json/event-organizer-toolkit/v1/update-accommodation"
delete_url = "{{hostname}}/delete-accommodation"
parameters = {
	"title": "%word",
    "description": "%text",
    "rooms": ["%email", "%url"]
}

responses = test_crud(create_url, read_url, update_url, delete_url, parameters, parameters, {}, {})
```

Read more about rest_test: [here](https://github.com/jaseppan/rest-test)

#### Add Accommodation
To add an accommodation, send a POST request to the following endpoint:

**Endpoint: {{hostname}}/wp-json/event-organizer-toolkit/v1/add-accommodation**

**Parameters:**

- **title**: The title of the accommodation.
- **description**: The description of the accommodation.
- **rooms**: A list of rooms associated with the accommodation.

**Example Request:**

```http
POST {{hostname}}/wp-json/event-organizer-toolkit/v1/add-accommodation HTTP/1.1
Content-Type: application/json

{
   "title":"Accommodation",
   "description":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget eleifend lacus.",
   "rooms":[
      "room 1",
      "room 2"
   ]
}
```

#### Edit Accommodation
To edit an accommodation, send a PUT request to the following endpoint:

**Endpoint: {{hostname}}/wp-json/event-organizer-toolkit/v1/update-accommodation**

**Parameters:**

- **id:** The ID of the accommodation you want to edit.
- **title:** The new title of the accommodation.
- **description:** The new description of the accommodation.
- **rooms**: A list of updated rooms associated with the accommodation.

**Example Request:**

```http
PUT {{hostname}}/wp-json/event-organizer-toolkit/v1/update-accommodation HTTP/1.1
Content-Type: application/json

{
   "id": [ID],
   "title":"Test accommodation",
   "description":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget eleifend lacus.",
   "rooms":[
      "Room 1",
      "Room 2"
   ]
}
```

#### Get Accommodation

To retrieve an accommodation, send a GET request to the following endpoint:

**Endpoint: {{hostname}}/wp-json/event-organizer-toolkit/v1/get-accommodation**

**Parameters:**

- **id:** The ID of the accommodation (optional).
- **title:** The title of the accommodation (optional).

**Note:** One of the parameters (id or title) must be defined.

**Example Request:**

```http
GET {{hostname}}/wp-json/event-organizer-toolkit/v1/get-accommodation?id={{id}} HTTP/1.1
Content-Type: application/json
```

#### List Accommodations

To list accommodations, send a GET request to the following endpoint:

**Endpoint: {{hostname}}/wp-json/event-organizer-toolkit/v1/list-accommodations**

**Parameters:**

- **items_per_page**: The number of items to return per page.
- **page**: The page number to return.
- **search**: The search term to use.
- **order_by**: The field to order by.
- **order**: The order to use (asc or desc).

**Example Request:**

```http
@parameters = search=Kontiola

GET {{hostname}}/wp-json/event-organizer-toolkit/v1/list-accommodations?{{parameters}} HTTP/1.1
Content-Type: application/json
```

#### Delete Accommodation

To delete an accommodation, send a DELETE request to the following endpoint:

**Endpoint: {{hostname}}/wp-json/event-organizer-toolkit/v1/delete-accommodation**

**Parameters:**

- **id**: The ID of the accommodation to delete.

**Example Request:**

```http
@id = 4

DELETE {{hostname}}/wp-json/event-organizer-toolkit/v1/delete-accommodation?id={{id}} HTTP/1.1
Content-Type: application/json
```