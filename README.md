
# kezakoPlant

Upload a photo of a plant, and KezakoPlant will tell you what it is!

https://user-images.githubusercontent.com/53975649/123602928-99accf80-d7f9-11eb-9b3e-98f931143644.mp4

# How to use it
- Upload all the files in the "app" folder to a web server (local or remote).
- Make sure there is a "uploads" folder in the "app folder"

# How it works
- KezakoPlant will upload your file locally,
- Call the Pl@ntNet API with this file,
- The Pl@ntNet API will return a JSON file with information about the plant,
- Read the JSON file and display info to the user.
