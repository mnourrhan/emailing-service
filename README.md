# emailing-service API
[emailing-service](https://github.com/mnourrhan/emailing-service) API - Sending multiple emails with attachments through API

## Installation
- Clone the repo
- Run "php artisan config:clear"
- Change the .env file DB_HOST with your local host and your DB configuration.
- Change QUEUE_CONNECTION into .env file to "redis"
- Add API_TOKEN to .env file for securing API
- Add ENCRYPTION_KEY to .env file for securing download attachments API
- Run "php artisan config:clear"
- Run "php artisan migrate"
- You can run "vendor/bin/phpunit" for testing the APIs

## Media Types
This API uses the JSON format, given limited client support `Content-Type` and `Accept` should still be set to `application/json`.

Requests with a message-body are using plain JSON to set or update resource states.

## Error States
status with fail value will be returned when error occur

Specially, this API uses:

- 200: "Successful", often return from a GET/POST request
- 422: "Failed", invalid request often return from a GET/POST request
- 500: "Failed", server error often return from a GET/POST request

## Send Emails [/api/v1/send-emails]
sending multiple emails.

The request body resource has the following attributes:
- body => string, max 500
- subject => string, max 100
- receiver_email => email, max 100
- attachments => array {value => base64 file, name => filename}

+ Request (application/json)

    + Headers

            Accept: application/json
    + Body
    
            [
                {
                    "body": "testing", 
                    "subject": "test",
                    "receiver_email": "test@test.com",
                     "attachments": 
                     [
                        {
                            "value": base64 file,
                            "name": "document"
                        },...
                     ]
                },...
            ]
    + Params
    
            api_token: "your api token from .env file"
            
+ Response 200

        {
            "message": "Emails are sent successfully",
            "data": {
            }
        }

+ Response 422  
  
      {
          "message": "The given data was invalid.",
          "errors": {
              "body": [
                "The body field is required."
              ],...
          }
      }
+ Response 500

      {
          "message": "Server error occurred. Please try again later!",
          "errors": {
          }
      }
      
## Retrieve all emails [/api/v1/emails]

+ Request (application/json)

    + Headers

            Accept: application/json

    + Body

            {
            }

    + Params
        
            api_token: "your api token from .env file"
            page: 1
                
+ Response 200

        {
            "data": [
                {
                   id: ...
                   body: ...
                   subject: ...
                   attachments: [
                        {
                            link: ...
                        },...
                   ]
                }, ...
            ],
            "links": {
                ...
            },
            "meta": {
               ...
            }
        }

+ Response 422

      {
          "message": "API token is invalid!",
          "errors": {
          }
      }

+ Response 500

      {
          "message": "Server error occurred. Please try again later!",
          "errors": {
          }
      }
