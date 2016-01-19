<h1>IECSE HOLOCAUST</h1>
<br><h2>Usage</h2>
<br>This is the backend to the Node Webkit front end which is an offline data storage and UI for registrations. 
<br>The process is that the User first logs in with admin password to be able to make an event. The event
<br>consists of the following : Event Name (Post name is 'event'), Event passkey (Post name is 'password') and 
<br> Form structure (Post Name is 'form_data'). The backend currently processes the JSON data recieved in form of 'form_data'
<br> to make a new table with the required specificaitons. 
<Br> <Br>
When the user(non admin) wants to load the available events, it is required that the user enters the password of the event.
<br>On Successful verification of the password, the backend sends the JSON format of the table. The frontend renders the JSON.
<br>Now the user can record data according to the forms which is stored locally on the computer until the user hits the upload
<br> button to the server which prompts the user to enter the password. On successful verification, the recorded data is sent
<br>to the server in form of JSON. The backend deciphers this code and stores into the database.
<br>
<br>
<h2>Form data format</h2>
Sample Form data :
{
	"form_data": [
        {
            "type": "textbox",
            "label": "Registration Number"
            "placeholder": "Nothing"
        },
        {
            "type": "checkbox",
            "label": "Programming languages you know?",
            "values": "C++,Java,Python"
        },
        {
            "type": "radiobutton",
            "label": "Had Coffee?",
            "values": "Yes,No"
        },
{
            "type": "radiobutton",
            "label": "Member?",
            "values": "Yes,No"
        }
    ]
}

<h2>Status Codes</h2>
Status codes for everything is very simple. True if action output/status is true, else false. 