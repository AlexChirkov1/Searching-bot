<?php 
$cities = array(
        "auburn", "bham", "dothan", "shoals" ,"gadsden", "huntsville", "mobile", "montgomery" ,"tuscaloosa","anchorage",
        "fairbanks", "kenai",
        "flagstaff",
        "mohave"
);

// "phoenix",
        // "prescott",​
        // "showlow",​
        // "sierravista",
        // "tucson",​
        // "yuma",
        // "fayar",​
        // "fortsmith",​
        // "jonesboro",​
        // "littlerock",​
        // "texarkana",​
        // "bakersfield",
        // "chico",​
        // "fresno",​
        // "goldcountry",​
        // "hanford",​
        // "humboldt", ​
        // "imperial", ​
        // "inlandempire",​
        // "losangeles",​
        // "mendocino",​
        // "merced",​
        // "modesto",​
        // "monterey",​
        // "orangecounty",​
        // "palmsprings",​
        // "redding",​
        // "sacramento",​
        // "sandiego",​
        // "sfbay",​
        // "slo",​
        // "santabarbara",​
        // "santamaria",​
        // "siskiyou",​
        // "stockton",​
        // "susanville",​
        // "ventura",​
        // "visalia",​
        // "yubasutter",
        // "boulder",​​
        // "cosprings",​
        // "denver",
        // "eastco",
        // "fortcollins",​
        // "rockies",​
        // "pueblo",​
        // "westslope",​
        // "newlondon",​
        // "hartford",​
        // "newhaven",​
        // "nwct",​
        // "delaware",​
        // "washingtondc",​
        // "daytona",
        // "keys",
        // "fortlauderdale",​
        // "fortmyers",
        // "gainesville",​
        // "cfl",​
        // "jacksonville",​
        // "lakeland",​
        // "lakecity",​
        // "ocala",
        // "okaloosa",
        // "orlando",​
        // "panamacity",​
        // "pensacola",​
        // "sarasota",​
        // "miami",​
        // "spacecoast",​
        // "staugustine",​
        // "tallahassee",​
        // "tampa",​
        // "treasure",​
        // "albanyga",​
        // "athensga",​
        // "atlanta",​
        // "augusta",
        // "brunswick",​
        // "columbusga",
        // "macon",​
        // "nwga",​
        // "savannah",​
        // "statesboro",​
        // "valdosta",​
        // "honolulu",​
        // "boise",​
        // "eastidaho",​
        // "lewiston",​
        // "twinfalls",​
        // "bn",​
        // "chambana",​
        // "chicago",​
        // "decatur",​decatur​</a>​
        // "lasalle",​la salle co​</a>​
        // "mattoon",​mattoon-charleston​</a>​
        // "peoria",​peoria​</a>​
        // "rockford",​rockford​</a>​
        // "carbondale",​southern illinois​</a>​
        // "springfieldil",​springfield ​</a>​
        // "quincy",​western IL​</a>​
        // "bloomington",​bloomington​</a>​
        // "evansville",​evansville​</a>​
        // "fortwayne",​fort wayne​</a>​
        // "indianapolis",​indianapolis​</a>​
        // "kokomo",​kokomo​</a>​
        // "tippecanoe",​lafayette / west lafayette​</a>​
        // "muncie",​muncie / anderson​</a>​
        // "richmondin",​richmond ​</a>​
        // "southbend",​south bend / michiana​</a>​
        // "terrehaute",​terre haute​</a>​
        // "ames",​ames​</a>​
        // "cedarrapids",​cedar rapids​</a>​
        // "desmoines",​des moines​</a>​
        // "dubuque",​dubuque​</a>​
        // "fortdodge",​fort dodge​</a>​
        // "iowacity",​iowa city​</a>​
        // "masoncity",​mason city​</a>​
        // "quadcities",​quad cities​</a>​
        // "siouxcity",​sioux city​</a>​
        // "ottumwa",​southeast IA​</a>​
        // "waterloo",​waterloo / cedar falls​</a>​
        // "lawrence",​lawrence​</a>​
        // "ksu",​manhattan​</a>​
        // "nwks",​northwest KS​</a>​
        // "salina",​salina​</a>​
        // "seks",​southeast KS​</a>​
        // "swks",​southwest KS​</a>​
        // "topeka",​topeka​</a>​
        // "wichita",​wichita​</a>​
        // "bgky",​bowling green​</a>​
        // "eastky",​eastern kentucky​</a>​
        // "lexington",​lexington​</a>​
        // "louisville",​louisville​</a>​
        // "owensboro",​owensboro​</a>​
        // "westky",​western KY​</a>​
        // "batonrouge",​baton rouge​</a>​
        // "cenla",​central louisiana​</a>​
        // "houma",​houma​</a>​
        // "lafayette",​lafayette​</a>​
        // "lakecharles",​lake charles​</a>​
        // "monroe",​monroe​</a>​
        // "neworleans",​new orleans​</a>​
        // "shreveport",​shreveport​</a>​
        // "maine",​maine​</a>​
        // "annapolis",​annapolis​</a>​
        // "baltimore",​baltimore​</a>​
        // "easternshore",​eastern shore​</a>​
        // "frederick",​frederick​</a>​
        // "smd",​southern maryland​</a>​
        // "westmd",​western maryland​</a>​
        // "boston",​boston​</a>​
        // "capecod",​cape cod / islands​</a>​
        // "southcoast",​south coast​</a>​
        // "westernmass",​western massachusetts​</a>​
        // "worcester",​worcester / central MA​</a>​
        // "annarbor",​ann arbor​</a>​
        // "battlecreek",​battle creek​</a>​
        // "centralmich",​central michigan​</a>​
        // "detroit",​detroit metro​</a>​
        // "flint",​flint​</a>​
        // "grandrapids",​grand rapids​</a>​
        // "holland",​holland​</a>​
        // "jxn",​jackson ​</a>​
        // "kalamazoo",​kalamazoo​</a>​
        // "lansing",​lansing​</a>​
        // "monroemi",​monroe ​</a>​
        // "muskegon",​muskegon​</a>​
        // "nmi",​northern michigan​</a>​
        // "porthuron",​port huron​</a>​
        // "saginaw",​saginaw-midland-baycity​</a>​
        // "swmi",​southwest michigan​</a>​
        // "thumb",​the thumb​</a>​
        // "up",​upper peninsula​</a>​
        // "bemidji",​bemidji​</a>​
        // "brainerd",​brainerd​</a>​
        // "duluth",​duluth / superior​</a>​
        // "mankato",​mankato​</a>​
        // "minneapolis",​minneapolis / st paul​</a>​
        // "rmn",​rochester ​</a>​
        // "marshall",​southwest MN​</a>​
        // "stcloud",​st cloud​</a>​
        // "gulfport",​gulfport / biloxi​</a>​
        // "hattiesburg",​hattiesburg​</a>​
        // "jackson",​jackson​</a>​
        // "meridian",​meridian​</a>​
        // "northmiss",​north mississippi​</a>​
        // "natchez",​southwest MS​</a>​
        // "columbiamo",​columbia / jeff city​</a>​
        // "joplin",​joplin​</a>​
        // "kansascity",​kansas city​</a>​
        // "kirksville",​kirksville​</a>​
        // "loz",​lake of the ozarks​</a>​
        // "semo",​southeast missouri​</a>​
        // "springfield",​springfield​</a>​
        // "stjoseph",​st joseph​</a>​
        // "stlouis",​st louis​</a>​
        // "billings",​billings​</a>​
        // "bozeman",​bozeman​</a>​
        // "butte",​butte​</a>​
        // "greatfalls",​great falls​</a>​
        // "helena",​helena​</a>​
        // "kalispell",​kalispell​</a>​
        // "missoula",​missoula​</a>​
        // "montana",​eastern montana​</a>​
        // "grandisland",​grand island​</a>​
        // "lincoln",​lincoln​</a>​
        // "northplatte",​north platte​</a>​
        // "omaha",​omaha / council bluffs​</a>​
        // "scottsbluff",​scottsbluff / panhandle​</a>​
        // "elko",​elko​</a>​
        // "lasvegas",​las vegas​</a>​
        // "reno",​reno / tahoe​</a>​
        // "nh",​new hampshire​</a>​
        // "cnj",​central NJ​</a>​
        // "jerseyshore",​jersey shore​</a>​
        // "newjersey",​north jersey​</a>​
        // "southjersey",​south jersey​</a>​
        // "albuquerque",​albuquerque​</a>​
        // "clovis",​clovis / portales​</a>​
        // "farmington",​farmington​</a>​
        // "lascruces",​las cruces​</a>​
        // "roswell",​roswell / carlsbad​</a>​
        // "santafe",​santa fe / taos​</a>​
        // "albany",​albany​</a>​
        // "binghamton",​binghamton​</a>​
        // "buffalo",​buffalo​</a>​
        // "catskills",​catskills​</a>​
        // "chautauqua",​chautauqua​</a>​
        // "elmira",​elmira-corning​</a>​
        // "fingerlakes",​finger lakes​</a>​
        // "glensfalls",​glens falls​</a>​
        // "hudsonvalley",​hudson valley​</a>​
        // "ithaca",​ithaca​</a>​
        // "longisland",​long island​</a>​
        // "newyork",​new york city​</a>​
        // "oneonta",​oneonta​</a>​
        // "plattsburgh",​plattsburgh-adirondacks​</a>​
        // "potsdam",​potsdam-canton-massena​</a>​
        // "rochester",​rochester​</a>​
        // "syracuse",​syracuse​</a>​
        // "twintiers",​twin tiers NY/PA​</a>​
        // "utica",​utica-rome-oneida​</a>​
        // "watertown",​watertown​</a>​
        // "asheville",​asheville​</a>​
        // "boone",​boone​</a>​
        // "charlotte",​charlotte​</a>​
        // "eastnc",​eastern NC​</a>​
        // "fayetteville",​fayetteville​</a>​
        // "greensboro",​greensboro​</a>​
        // "hickory",​hickory / lenoir​</a>​
        // "onslow",​jacksonville ​</a>​
        // "outerbanks",​outer banks​</a>​
        // "raleigh",​raleigh / durham / CH​</a>​
        // "wilmington",​wilmington​</a>​
        // "winstonsalem",​winston-salem​</a>​
        // "bismarck",​bismarck​</a>​
        // "fargo",​fargo / moorhead​</a>​
        // "grandforks",​grand forks​</a>​
        // "nd",​north dakota​</a>​
        // "akroncanton",​akron / canton​</a>​
        // "ashtabula",​ashtabula​</a>​
        // "athensohio",​athens ​</a>​
        // "chillicothe",​chillicothe​</a>​
        // "cincinnati",​cincinnati​</a>​
        // "cleveland",​cleveland​</a>​
        // "columbus",​columbus​</a>​
        // "dayton",​dayton / springfield​</a>​
        // "limaohio",​lima / findlay​</a>​
        // "mansfield",​mansfield​</a>​
        // "sandusky",​sandusky​</a>​
        // "toledo",​toledo​</a>​
        // "tuscarawas",​tuscarawas co​</a>​
        // "youngstown",​youngstown​</a>​
        // "zanesville",​zanesville / cambridge​</a>​
        // "lawton",​lawton​</a>​
        // "enid",​northwest OK​</a>​
        // "oklahomacity",​oklahoma city​</a>​
        // "stillwater",​stillwater​</a>​
        // "tulsa",​tulsa​</a>​
        // "bend",​bend​</a>​
        // "corvallis",​corvallis/albany​</a>​
        // "eastoregon",​east oregon​</a>​
        // "eugene",​eugene​</a>​
        // "klamath",​klamath falls​</a>​
        // "medford",​medford-ashland​</a>​
        // "oregoncoast",​oregon coast​</a>​
        // "portland",​portland​</a>​
        // "roseburg",​roseburg​</a>​
        // "salem",​salem​</a>​
        // "altoona",​altoona-johnstown​</a>​
        // "chambersburg",​cumberland valley​</a>​
        // "erie",​erie​</a>​
        // "harrisburg",​harrisburg​</a>​
        // "lancaster",​lancaster​</a>​
        // "allentown",​lehigh valley​</a>​
        // "meadville",​meadville​</a>​
        // "philadelphia",​philadelphia​</a>​
        // "pittsburgh",​pittsburgh​</a>​
        // "poconos",​poconos​</a>​
        // "reading",​reading​</a>​
        // "scranton",​scranton / wilkes-barre​</a>​
        // "pennstate",​state college​</a>​
        // "williamsport",​williamsport​</a>​
        // "york",​york​</a>​
        // "providence",​rhode island​</a>​
        // "charleston",​charleston​</a>​
        // "columbia",​columbia​</a>​
        // "florencesc",​florence​</a>​
        // "greenville",​greenville / upstate​</a>​
        // "hiltonhead",​hilton head​</a>​
        // "myrtlebeach",​myrtle beach​</a>​
        // "nesd",​northeast SD​</a>​
        // "csd",​pierre / central SD​</a>​
        // "rapidcity",​rapid city / west SD​</a>​
        // "siouxfalls",​sioux falls / SE SD​</a>​
        // "sd",​south dakota​</a>​
        // "chattanooga",​chattanooga​</a>​
        // "clarksville",​clarksville​</a>​
        // "cookeville",​cookeville​</a>​
        // "jacksontn",​jackson  ​</a>​
        // "knoxville",​knoxville​</a>​
        // "memphis",​memphis​</a>​
        // "nashville",​nashville​</a>​
        // "tricities",​tri-cities​</a>​
        // "abilene",​abilene​</a>​
        // "amarillo",​amarillo​</a>​
        // "austin",​austin​</a>​
        // "beaumont",​beaumont / port arthur​</a>​
        // "brownsville",​brownsville​</a>​
        // "collegestation",​college station​</a>​
        // "corpuschristi",​corpus christi​</a>​
        // "dallas",​dallas / fort worth​</a>​
        // "nacogdoches",​deep east texas​</a>​
        // "delrio",​del rio / eagle pass​</a>​
        // "elpaso",​el paso​</a>​
        // "galveston",​galveston​</a>​
        // "houston",​houston​</a>​
        // "killeen",​killeen / temple / ft hood​</a>​
        // "laredo",​laredo​</a>​
        // "lubbock",​lubbock​</a>​
        // "mcallen",​mcallen / edinburg​</a>​
        // "odessa",​odessa / midland​</a>​
        // "sanangelo",​san angelo​</a>​
        // "sanantonio",​san antonio​</a>​
        // "sanmarcos",​san marcos​</a>​
        // "bigbend",​southwest TX​</a>​
        // "texoma",​texoma​</a>​
        // "easttexas",​tyler / east TX​</a>​
        // "victoriatx",​victoria ​</a>​
        // "waco",​waco​</a>​
        // "wichitafalls",​wichita falls​</a>​
        // "logan",​logan​</a>​
        // "ogden",​ogden-clearfield​</a>​
        // "provo",​provo / orem​</a>​
        // "saltlakecity",​salt lake city​</a>​
        // "stgeorge",​st george​</a>​
        // "vermont",​vermont​</a>​
        // "charlottesville",​charlottesville​</a>​
        // "danville",​danville​</a>​
        // "fredericksburg",​fredericksburg​</a>​
        // "norfolk",​hampton roads​</a>​
        // "harrisonburg",​harrisonburg​</a>​
        // "lynchburg",​lynchburg​</a>​
        // "blacksburg",​new river valley​</a>​
        // "richmond",​richmond​</a>​
        // "roanoke",​roanoke​</a>​
        // "swva",​southwest VA​</a>​
        // "winchester",​winchester​</a>​
        // "bellingham",​bellingham​</a>​
        // "kpr",​kennewick-pasco-richland​</a>​
        // "moseslake",​moses lake​</a>​
        // "olympic",​olympic peninsula​</a>​
        // "pullman",​pullman / moscow​</a>​
        // "seattle",​seattle-tacoma​</a>​
        // "skagit",​skagit / island / SJI​</a>​
        // "spokane",​spokane / coeur d'alene​</a>​
        // "wenatchee",​wenatchee​</a>​
        // "yakima",​yakima​</a>​
        // "charlestonwv",​charleston ​</a>​
        // "martinsburg",​eastern panhandle​</a>​
        // "huntington",​huntington-ashland​</a>​
        // "morgantown",​morgantown​</a>​
        // "wheeling",​northern panhandle​</a>​
        // "parkersburg",​parkersburg-marietta​</a>​
        // "swv",​southern WV​</a>​
        // "wv",​west virginia (old)​</a>​
        // "appleton",​appleton-oshkosh-FDL​</a>​
        // "eauclaire",​eau claire​</a>​
        // "greenbay",​green bay​</a>​
        // "janesville",​janesville​</a>​
        // "racine",​kenosha-racine​</a>​
        // "lacrosse",​la crosse​</a>​
        // "madison",​madison​</a>​
        // "milwaukee",​milwaukee​</a>​
        // "northernwi",​northern WI​</a>​
        // "sheboygan",​sheboygan​</a>​
        // "wausau",​wausau​</a>​
        // "wyoming",​wyoming​</a>​
        // "micronesia",​guam-micronesia​</a>​
        // "puertorico",​puerto rico​</a>​
        // "virgin",​U.S. virgin islands​</a>​