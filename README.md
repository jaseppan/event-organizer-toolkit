# Project Name: Event Organizer Toolkit (Under Construction)
Event Organizer Toolkit is an in-progress WordPress plugin that provides REST API endpoints for managing accommodations and an accommodation admin user interface for listing, adding, editing, and deleting accommodations. Please note that this project is currently under construction and should be used with caution, preferably in a local development environment.

The aim of the project is to develop a WordPress plugin that serves as a tool for event organizers to create accommodation and dining lists for registered participants, as well as generate name tags and meal tickets.

## Features
REST API endpoints for accommodations management.
Accommodation admin UI for listing, adding, editing, and deleting accommodations.

## Caution
This project is currently under construction and may contain bugs or incomplete features.
The REST API endpoints do not currently use authentication, so exercise caution and only test the plugin locally in a development environment.
Be sure to back up your data before using this plugin in any WordPress installation.
Please note that this README serves as an initial guide and will be updated as the project progresses and new features are added.


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