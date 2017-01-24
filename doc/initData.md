generic Init Data 
=========

- model Admin
- checkInitData
- initData is not responsable for malformed json, should be run through a jslint validation
- initData from /data/something.json
- initData from php controller like sig / actionInitDataNetworkMapping
- a dataFile can contain multiple destination data checkout personNetworkingAll.json and will be processed using insertDataFromFile
- removeInitData() reverses the process of initData
- option : if linkAllToActiveUser:true is specified This builds a first level linking properties to and from the active user

TODO 
=========

option : a dataFile can contain process_links which in turn builds all the explicit links specified in the dataset 

'''
"process_links":[
        {
            "from":"activeUser",    "fromType":"citoyen",
            "to":"_id", "toType":"citoyen", 
            "fromlink":"links.knows", 
            "tolink":"links.knows"
        },
        {
            "from":"activeUser",     "fromType":"citoyen",
            "to":"_id",  "toType":"organisation", 
            "fromlink":"links.memberOf",
            "tolink":"links.members"
        },
    ]
'''

