### Create Print jobs

`POST https://serverurl/printJobs`

| FIELD | Value |
|-------|-------|
| uuid  | An unique identifier for the printer |
| job   | the job itself, for epsons it should be an epos xml string |

For the printers to print
#### Epson ####
In the Cloud print section put the server:
`https://serverurl/epson/printJobs`
and in `ID` the same `uuid` you send for your jobs



