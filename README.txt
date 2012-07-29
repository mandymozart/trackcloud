TrackCloud TM (alternatively TrackHub TM)

Collaboration Tool - 
Github inspired Hub

To be integrated into Containa.

TODO:

- setup CI REST Server

- ZIP Folder 
- finish #jquery.hasher.js for autoloading and hashtag splitting (public getDir for getSong, getSet, getTrack)


- Overlay CSS for playerView & tracksList
- Share Link

Backlog:

-
- Integrate playerView into tracksList
- All Tracks SYNC_playback (Master Time)
- Song*Set Modi:
 - 1. LIST: align tracks behind each under (unlimited amount of tracks)
 - 2. MIX: align tracks underneath (limit to 8 tracks for performance)
 - Extend, write Class for another jquery plugin that can easily attach
 	[-] getSong - Multitrack listing of Directory
 	[-] getSet - same but lineup tracks in Playlist
- CRON Job MP3 conversion for faster prelistening on demand. (conversion widget)

Environment Considerations:
- Write Ajax to S3 Server, for file storage...

Security Bugs:

- integrate error handling to folder.json loader
