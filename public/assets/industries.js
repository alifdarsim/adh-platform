let industries = {
    "Energy(Oil/Gas/Coal)": [
        {
            "Oil/Gas Driling/Field Services": [
                "Oil and Gas Exploration Services",
                "Oil and Gas Production"
            ],
            "Integrated Oil and Gas": [],
            "Oil/Gas Upstream(E&P)": [],
            "Oil and Gas Refining and Marketing(Crude oil/NG/LNG/Lubricant)": [],
            "Oil and Gas Storage and Transportation(Pipeline/Tanker)": [],
            "Coal and other consumable fuels": []
        }
    ],
    "Material(Chemical/Pulp&Paper/Metal&Mining)": [
        {
            "Chemicals": [
                "Commodity Chemicals",
                "Diversified Chemicals",
                "Fertilizers and Agricultural Chemicals",
                "Specialty Chemicals"
            ],
            "Construction Materials": [],
            "Containers and Packaging": [],
            "Metals and Mining": [
                "Aluminum",
                "Copper",
                "Diversified Metals and Mining",
                "Gold",
                "Precious Metals and Minerals",
                "Silver",
                "Steel"
            ],
            "Paper and Forest Products": [
                "Forest Products",
                "Paper Products"
            ]
        }
    ],
    "Manufacture(Capital Goods)": [
        {
            "Aerospace and Defense": [],
            "Building Products": [],
            "Electrical Equipment": [],
            "Industrial Conglomerates": [],
            "Machinery": []
        }
    ],
    "Manufacturing(Auto components/Auto)": [
        {
            "Auto Components": [],
            "Automobiles": []
        }
    ],
    "Manufacturing(Consumer Durables/Apparel)": [
        {
            "Household Durables(Consumer Electronics/Home Furnishings)": [
                "Consumer Electronics",
                "Home Furnishings",
                "Homebuilding",
                "Household Appliances",
                "Housewares and Specialties"
            ],
            "Leisure Products": [],
            "Textiles, Apparel and Luxury Goods": []
        }
    ],
    "Manufacturing(Food & Beverage/Tabacco)": [
        {
            "Beverages": [],
            "Food Products": [
                "Agricultural Products",
                "Packaged Foods and Meats"
            ],
            "Tobacco": []
        }
    ],
    "Trading Companies and Distributors": [
        {
            "Building Product Distribution": [],
            "Chemical Distribution": [],
            "Construction Material Distribution": [],
            "Electrical Equipment Distribution": [],
            "Machinery Distribution": [],
            "Machinery Rental and Leasing": [],
            "Paper and Forest Product Distribution": [],
            "Transportation Equipment and Supplies Distribution": [],
            "Durable Goods Distribution": [],
            "Media Distribution": [],
            "Non-Durable Goods Distribution": [],
            "Food Distributors": []
        }
    ],
    "Retail": [
        {
            "Internet and Direct Marketing Retail": [],
            "GMS/Department retail": [],
            "Specialty Retail": [],
            "Hypermarkets and Super Centers": []
        }
    ],
    "Construction and Engineering": [
        {
            "Commercial Construction and Engineering": [],
            "Construction Support Services": [],
            "Heavy Construction": [],
            "Prefabricated Buildings and Components": [],
            "Specialty Contract Work": []
        }
    ],
    "Commercial service": [],
    "Professional services": [
        {
            "Human Resource and Employment Services": [],
            "Accounting, Auditing and Taxation Services": [],
            "Consulting Services": [],
            "Credit Reporting Services": [],
            "Legal Services": [],
            "Research, Development, and Testing Services": []
        }
    ],
    "Consumer Services": [
        {
            "Diversified Consumer Services": [],
            "Education Services": [],
            "Specialized Consumer Services": [],
            "Hotels, Restaurants and Leisure": []
        }
    ],
    "Health Care": [
        {
            "Healthecare Equipment": [],
            "Health Care Providers and Services": [],
            "Biotechnology": [],
            "Life Sciences Tools and Services": [],
            "Pharmaceuticals": []
        }
    ],
    "Financials": [
        {
            "Banks": [],
            "Capital Markets(Security/Asset Management/Investment Bank)": [
                "Asset Management and Custody Banks",
                "Diversified Capital Markets",
                "Financial Exchanges and Data",
                "Investment Banking and Brokerage"
            ],
            "Consumer Finance": [],
            "Insurance": [
                "Insurance Brokers",
                "Life and Health Insurance",
                "Multi-line Insurance",
                "Property and Casualty Insurance",
                "Reinsurance"
            ]
        }
    ],
    "Information Technology": [
        {
            "Semiconductors and Semiconductor Equipment": [],
            "Software and Services": [
                "IT Services",
                "Software"
            ],
            "Technology Hardware and Equipment": [
                "Communications Equipment",
                "Technology Hardware, Storage and Peripherals",
                "Electronic Equipment, Instruments and Components"
            ]
        }
    ],
    "Communication Services": [
        {
            "Telecommunication Services": [],
            "Media(Advertising/Broad casting/Publishing)": [
                "Advertising",
                "Broadcasting",
                "Cable and Satellite",
                "Publishing"
            ],
            "Movie/Entertainment(Game etc)": [
                "Entertainment Equipment",
                "Entertainment Production Companies",
                "Entertainment Services",
                "Entertainment Venues",
                "Educational and Training Software",
                "Entertainment Software(Game)"
            ],
            "Interactive Media and Services(Online services)": []
        }
    ],
    "Transportation": [
        {
            "Air Freight and Logistics": [],
            "Airlines": [],
            "Marine": [],
            "Road and Rail": [],
            "Transportation Infrastructure": []
        }
    ],
    "Utilities": [
        {
            "Electric Utilities": [],
            "Gas Utilities": [],
            "Water Utilities": []
        }
    ],
    "Real Estate": [
        {
            "Equity Real Estate Investment Trusts (REITs)": [],
            "Diversified Real Estate Activities": [],
            "Real Estate Development": [],
            "Real Estate Operating Companies": []
        }
    ]
}

let industriesSelect2 = [
    {
        text: "Energy (Oil/Gas/Coal)",
        children: [
            { id: "Oil/Gas Driling/Field Services", text: "Oil/Gas Driling/Field Services", children: [
                    { id: "Oil and Gas Exploration Services", text: "Oil and Gas Exploration Services" },
                    { id: "Oil and Gas Production", text: "Oil and Gas Production" }
                ]},
            { id: "Integrated Oil and Gas", text: "Integrated Oil and Gas" },
            { id: "Oil/Gas Upstream(E&P)", text: "Oil/Gas Upstream(E&P)" },
            { id: "Oil and Gas Refining and Marketing(Crude oil/NG/LNG/Lubricant)", text: "Oil and Gas Refining and Marketing(Crude oil/NG/LNG/Lubricant)" },
            { id: "Oil and Gas Storage and Transportation(Pipeline/Tanker)", text: "Oil and Gas Storage and Transportation(Pipeline/Tanker)" },
            { id: "Coal and other consumable fuels", text: "Coal and other consumable fuels" }
        ]
    },
    {
        text: "Material (Chemical/Pulp&Paper/Metal&Mining)",
        children: [
            { id: "Chemicals", text: "Chemicals", children: [
                    { id: "Commodity Chemicals", text: "Commodity Chemicals" },
                    { id: "Diversified Chemicals", text: "Diversified Chemicals" },
                    { id: "Fertilizers and Agricultural Chemicals", text: "Fertilizers and Agricultural Chemicals" },
                    { id: "Specialty Chemicals", text: "Specialty Chemicals" }
                ]},
            { id: "Construction Materials", text: "Construction Materials" },
            { id: "Containers and Packaging", text: "Containers and Packaging" },
            { id: "Metals and Mining", text: "Metals and Mining", children: [
                    { id: "Aluminum", text: "Aluminum" },
                    { id: "Copper", text: "Copper" },
                    { id: "Diversified Metals and Mining", text: "Diversified Metals and Mining" },
                    { id: "Gold", text: "Gold" },
                    { id: "Precious Metals and Minerals", text: "Precious Metals and Minerals" },
                    { id: "Silver", text: "Silver" },
                    { id: "Steel", text: "Steel" }
                ]},
            { id: "Paper and Forest Products", text: "Paper and Forest Products", children: [
                    { id: "Forest Products", text: "Forest Products" },
                    { id: "Paper Products", text: "Paper Products" }
                ]}
        ]
    },
    {
        text: "Manufacture (Capital Goods)",
        children: [
            { id: "Aerospace and Defense", text: "Aerospace and Defense" },
            { id: "Building Products", text: "Building Products" },
            { id: "Electrical Equipment", text: "Electrical Equipment" },
            { id: "Industrial Conglomerates", text: "Industrial Conglomerates" },
            { id: "Machinery", text: "Machinery" }
        ]
    },
    {
        text: "Manufacturing (Auto components/Auto)",
        children: [
            { id: "Auto Components", text: "Auto Components" },
            { id: "Automobiles", text: "Automobiles" }
        ]
    },
    {
        text: "Manufacturing (Consumer Durables/Apparel)",
        children: [
            { id: "Household Durables(Consumer Electronics/Home Furnishings)", text: "Household Durables(Consumer Electronics/Home Furnishings)", children: [
                    { id: "Consumer Electronics", text: "Consumer Electronics" },
                    { id: "Home Furnishings", text: "Home Furnishings" },
                    { id: "Homebuilding", text: "Homebuilding" },
                    { id: "Household Appliances", text: "Household Appliances" },
                    { id: "Housewares and Specialties", text: "Housewares and Specialties" }
                ]},
            { id: "Leisure Products", text: "Leisure Products" },
            { id: "Textiles, Apparel and Luxury Goods", text: "Textiles, Apparel and Luxury Goods" }
        ]
    },
    {
        text: "Manufacturing (Food & Beverage/Tabacco)",
        children: [
            { id: "Beverages", text: "Beverages" },
            { id: "Food Products", text: "Food Products", children: [
                    { id: "Agricultural Products", text: "Agricultural Products" },
                    { id: "Packaged Foods and Meats", text: "Packaged Foods and Meats" }
                ]},
            { id: "Tobacco", text: "Tobacco" }
        ]
    },
    {
        text: "Trading Companies and Distributors",
        children: [
            { id: "Building Product Distribution", text: "Building Product Distribution" },
            { id: "Chemical Distribution", text: "Chemical Distribution" },
            { id: "Construction Material Distribution", text: "Construction Material Distribution" },
            { id: "Electrical Equipment Distribution", text: "Electrical Equipment Distribution" },
            { id: "Machinery Distribution", text: "Machinery Distribution" },
            { id: "Machinery Rental and Leasing", text: "Machinery Rental and Leasing" },
            { id: "Paper and Forest Product Distribution", text: "Paper and Forest Product Distribution" },
            { id: "Transportation Equipment and Supplies Distribution", text: "Transportation Equipment and Supplies Distribution" },
            { id: "Durable Goods Distribution", text: "Durable Goods Distribution" },
            { id: "Media Distribution", text: "Media Distribution" },
            { id: "Non-Durable Goods Distribution", text: "Non-Durable Goods Distribution" },
            { id: "Food Distributors", text: "Food Distributors" }
        ]
    },
    {
        text: "Retail",
        children: [
            { id: "Internet and Direct Marketing Retail", text: "Internet and Direct Marketing Retail" },
            { id: "GMS/Department retail", text: "GMS/Department retail" },
            { id: "Specialty Retail", text: "Specialty Retail" },
            { id: "Hypermarkets and Super Centers", text: "Hypermarkets and Super Centers" }
        ]
    },
    {
        text: "Construction and Engineering",
        children: [
            { id: "Commercial Construction and Engineering", text: "Commercial Construction and Engineering" },
            { id: "Construction Support Services", text: "Construction Support Services" },
            { id: "Heavy Construction", text: "Heavy Construction" },
            { id: "Prefabricated Buildings and Components", text: "Prefabricated Buildings and Components" },
            { id: "Specialty Contract Work", text: "Specialty Contract Work" }
        ]
    },
    {
        text: "Commercial service",
        children: []
    },
    {
        text: "Professional services",
        children: [
            { id: "Human Resource and Employment Services", text: "Human Resource and Employment Services" },
            { id: "Accounting, Auditing and Taxation Services", text: "Accounting, Auditing and Taxation Services" },
            { id: "Consulting Services", text: "Consulting Services" },
            { id: "Credit Reporting Services", text: "Credit Reporting Services" },
            { id: "Legal Services", text: "Legal Services" },
            { id: "Research, Development, and Testing Services", text: "Research, Development, and Testing Services" }
        ]
    },
    {
        text: "Consumer Services",
        children: [
            { id: "Diversified Consumer Services", text: "Diversified Consumer Services" },
            { id: "Education Services", text: "Education Services" },
            { id: "Specialized Consumer Services", text: "Specialized Consumer Services" },
            { id: "Hotels, Restaurants and Leisure", text: "Hotels, Restaurants and Leisure" }
        ]
    },
    {
        text: "Health Care",
        children: [
            { id: "Healthcare Equipment", text: "Healthcare Equipment" },
            { id: "Health Care Providers and Services", text: "Health Care Providers and Services" },
            { id: "Biotechnology", text: "Biotechnology" },
            { id: "Life Sciences Tools and Services", text: "Life Sciences Tools and Services" },
            { id: "Pharmaceuticals", text: "Pharmaceuticals" }
        ]
    },
    {
        text: "Financials",
        children: [
            { id: "Banks", text: "Banks" },
            { id: "Capital Markets(Security/Asset Management/Investment Bank)", text: "Capital Markets(Security/Asset Management/Investment Bank)", children: [
                    { id: "Asset Management and Custody Banks", text: "Asset Management and Custody Banks" },
                    { id: "Diversified Capital Markets", text: "Diversified Capital Markets" },
                    { id: "Financial Exchanges and Data", text: "Financial Exchanges and Data" },
                    { id: "Investment Banking and Brokerage", text: "Investment Banking and Brokerage" }
                ]},
            { id: "Consumer Finance", text: "Consumer Finance" },
            { id: "Insurance", text: "Insurance", children: [
                    { id: "Insurance Brokers", text: "Insurance Brokers" },
                    { id: "Life and Health Insurance", text: "Life and Health Insurance" },
                    { id: "Multi-line Insurance", text: "Multi-line Insurance" },
                    { id: "Property and Casualty Insurance", text: "Property and Casualty Insurance" },
                    { id: "Reinsurance", text: "Reinsurance" }
                ]}
        ]
    },
    {
        text: "Information Technology",
        children: [
            { id: "Semiconductors and Semiconductor Equipment", text: "Semiconductors and Semiconductor Equipment" },
            { id: "Software and Services", text: "Software and Services", children: [
                    { id: "IT Services", text: "IT Services" },
                    { id: "Software", text: "Software" }
                ]},
            { id: "Technology Hardware and Equipment", text: "Technology Hardware and Equipment", children: [
                    { id: "Communications Equipment", text: "Communications Equipment" },
                    { id: "Technology Hardware, Storage and Peripherals", text: "Technology Hardware, Storage and Peripherals" },
                    { id: "Electronic Equipment, Instruments and Components", text: "Electronic Equipment, Instruments and Components" }
                ]}
        ]
    },
    {
        text: "Communication Services",
        children: [
            { id: "Telecommunication Services", text: "Telecommunication Services" },
            { id: "Media(Advertising/Broad casting/Publishing)", text: "Media(Advertising/Broad casting/Publishing)", children: [
                    { id: "Advertising", text: "Advertising" },
                    { id: "Broadcasting", text: "Broadcasting" },
                    { id: "Cable and Satellite", text: "Cable and Satellite" },
                    { id: "Publishing", text: "Publishing" }
                ]},
            { id: "Movie/Entertainment(Game etc)", text: "Movie/Entertainment(Game etc)", children: [
                    { id: "Entertainment Equipment", text: "Entertainment Equipment" },
                    { id: "Entertainment Production Companies", text: "Entertainment Production Companies" },
                    { id: "Entertainment Services", text: "Entertainment Services" },
                    { id: "Entertainment Venues", text: "Entertainment Venues" },
                    { id: "Educational and Training Software", text: "Educational and Training Software" },
                    { id: "Entertainment Software(Game)", text: "Entertainment Software(Game)" }
                ]},
            { id: "Interactive Media and Services(Online services)", text: "Interactive Media and Services(Online services)" }
        ]
    },
    {
        text: "Transportation",
        children: [
            { id: "Air Freight and Logistics", text: "Air Freight and Logistics" },
            { id: "Airlines", text: "Airlines" },
            { id: "Marine", text: "Marine" },
            { id: "Road and Rail", text: "Road and Rail" },
            { id: "Transportation Infrastructure", text: "Transportation Infrastructure" }
        ]
    },
    {
        text: "Utilities",
        children: [
            { id: "Electric Utilities", text: "Electric Utilities" },
            { id: "Gas Utilities", text: "Gas Utilities" },
            { id: "Water Utilities", text: "Water Utilities" }
        ]
    },
    {
        text: "Real Estate",
        children: [
            { id: "Equity Real Estate Investment Trusts (REITs)", text: "Equity Real Estate Investment Trusts (REITs)" },
            { id: "Diversified Real Estate Activities", text: "Diversified Real Estate Activities" },
            { id: "Real Estate Development", text: "Real Estate Development" },
            { id: "Real Estate Operating Companies", text: "Real Estate Operating Companies" }
        ]
    }
];

const products = [
    "Oil",
    "Gas",
    "Coal",
    "Exploration",
    "Production",
    "Integrated",
    "Upstream",
    "Refining",
    "Marketing",
    "Storage",
    "Transportation",
    "Commodity",
    "Diversified",
    "Fertilizers",
    "Chemicals",
    "Aluminum",
    "Copper",
    "Metals",
    "Gold",
    "Precious",
    "Silver",
    "Steel",
    "Forest",
    "Paper",
    "Aerospace",
    "Defense",
    "Building",
    "Electrical",
    "Industrial",
    "Machinery",
    "Auto",
    "Components",
    "Automobiles",
    "Consumer",
    "Electronics",
    "Home",
    "Furnishings",
    "Homebuilding",
    "Appliances",
    "Housewares",
    "Leisure",
    "Textiles",
    "Apparel",
    "Beverages",
    "Agricultural",
    "Packaged",
    "Meats",
    "Tobacco",
    "Building",
    "Chemical",
    "Construction",
    "Equipment",
    "Rental",
    "Leasing",
    "Transportation",
    "Durable",
    "Media",
    "Non-Durable",
    "Food",
    "Internet",
    "Marketing",
    "Retail",
    "GMS",
    "Department",
    "Specialty",
    "Hypermarkets",
    "Construction",
    "Engineering",
    "Support",
    "Heavy",
    "Prefabricated",
    "Contract",
    "Commercial",
    "Professional",
    "Human",
    "Resource",
    "Employment",
    "Accounting",
    "Auditing",
    "Taxation",
    "Consulting",
    "Credit",
    "Legal",
    "Research",
    "Development",
    "Testing",
    "Diversified",
    "Education",
    "Specialized",
    "Hotels",
    "Restaurants",
    "Health",
    "Equipment",
    "Providers",
    "Biotechnology",
    "Life",
    "Sciences",
    "Pharmaceuticals",
    "Banks",
    "Capital",
    "Markets",
    "Security",
    "Asset",
    "Management",
    "Investment",
    "Bank",
    "Consumer",
    "Insurance",
    "Brokers",
    "Life",
    "Health",
    "Multi-line",
    "Property",
    "Casualty",
    "Reinsurance",
    "Semiconductors",
    "IT",
    "Software",
    "Services",
    "Hardware",
    "Storage",
    "Peripherals",
    "Electronic",
    "Telecommunication",
    "Advertising",
    "Broadcasting",
    "Cable",
    "Satellite",
    "Publishing",
    "Entertainment",
    "Equipment",
    "Production",
    "Venues",
    "Educational",
    "Training",
    "Air",
    "Freight",
    "Logistics",
    "Airlines",
    "Marine",
    "Road",
    "Rail",
    "Infrastructure",
    "Electric",
    "Water",
    "Equity",
    "Real",
    "Estate",
    "Investment",
    "Trusts",
    "Diversified",
    "Development",
    "Operating",
    "Companies",
    "AI"
];

const otherTags = [
    "Technology",
    "Innovation",
    "Sustainability",
    "Environment",
    "Renewable",
    "Efficiency",
    "Infrastructure",
    "Digital",
    "Automation",
    "Transport",
    "Logistics",
    "Supply Chain",
    "Customer Service",
    "E-commerce",
    "Marketplace",
    "Data Analytics",
    "Cybersecurity",
    "Cloud Computing",
    "Artificial Intelligence",
    "Robotics",
    "Healthcare",
    "Wellness",
    "Fitness",
    "Telemedicine",
    "Education",
    "Online Learning",
    "Smart Cities",
    "Green Energy",
    "Finance",
    "Investment",
    "Economy",
    "Blockchain",
    "Cryptocurrency",
    "Fintech",
    "Insurtech",
    "Startups",
    "Entrepreneurship",
    "Innovation",
    "Management",
    "Consulting",
    "Legal",
    "Regulation",
    "Compliance",
    "Taxation",
    "Research",
    "Development",
    "Testing",
    "Entertainment",
    "Streaming",
    "Gaming",
    "Arts",
    "Culture",
    "Travel",
    "Tourism",
    "Hospitality",
    "Leisure",
    "Lifestyle",
    "Fashion",
    "Beauty",
    "Design",
    "Art",
    "Music",
    "Sports",
    "Outdoor",
    "Adventure",
    "Pets",
    "Hobbies",
    "Crafts",
    "Home Improvement",
    "DIY",
    "Food",
    "Cuisine",
    "Cooking",
    "Dining",
    "Catering",
    "Beverages",
    "Mixology",
    "Wine",
    "Craft Beer",
    "Spirits",
    "Health",
    "Wellness",
    "Fitness",
    "Mental Health",
    "Nutrition",
    "Diet",
    "Beauty",
    "Skincare",
    "Haircare",
    "Fashion",
    "Apparel",
    "Accessories",
    "Jewelry",
    "Footwear",
    "Electronics",
    "Gadgets",
    "Smart Devices",
    "Internet of Things",
    "Home Automation",
    "Virtual Reality",
    "Augmented Reality",
    "Travel",
    "Tourism",
    "Adventure",
    "Ecotourism",
    "Cultural Experiences",
    "Luxury Travel",
    "Sports",
    "Athletics",
    "Team Sports",
    "Extreme Sports",
    "Outdoor Activities",
    "Arts",
    "Crafts",
    "DIY",
    "Hobbies",
    "Collectibles",
    "Gaming",
    "Board Games",
    "Card Games",
    "Puzzles",
    "Home Improvement",
    "Renovation",
    "Interior Design",
    "Gardening",
    "Pets",
    "Pet Care",
    "Pet Supplies",
    "Pet Training",
    "Hobbies",
    "Collectibles",
    "Outdoor",
    "Adventures",
    "Exploration",
    "Stargazing",
    "Amateur Astronomy",
    "Crafts",
    "Handmade",
    "Artisan",
    "Sustainability",
    "Eco-friendly",
    "Recycling",
    "Zero Waste",
    "Upcycling",
    "Renewable Energy",
    "Solar Power",
    "Wind Power",
    "Hydropower",
    "Geothermal Energy",
    "Environmental Conservation",
    "Wildlife Preservation",
    "Ocean Conservation",
    "Green Building",
    "Eco-Tourism",
    "Sustainable Agriculture",
    "Circular Economy",
    "Social Impact",
    "Philanthropy",
    "Volunteerism",
    "Community Engagement",
    "Social Justice",
    "Equality",
    "Diversity",
    "Inclusion",
    "Human Rights",
    "Environmental Advocacy",
    "Climate Change",
    "Clean Energy",
    "Conservation",
    "Renewable Resources",
    "Circular Economy",
    "Digital Transformation",
    "Cloud Services",
    "Big Data",
    "Machine Learning",
    "Cybersecurity",
    "Internet Security",
    "Privacy",
    "Data Protection",
    "Smart Technology",
    "Automation",
    "Artificial Intelligence",
    "Robotics",
    "Blockchain Technology",
    "Cryptocurrency",
    "Digital Banking",
    "Online Payments",
    "Financial Technology",
    "Insurance Technology",
    "Startup",
    "Entrepreneurship",
    "Business Innovation",
    "Management Consulting",
    "Legal Services",
    "Regulatory Compliance",
    "Tax Consulting",
    "Market Research",
    "Product Development",
    "Quality Assurance",
    "Entertainment",
    "Streaming Services",
    "Gaming Industry",
    "Arts and Culture",
    "Music",
    "Film",
    "Theater",
    "Television",
    "Sports",
    "Professional Sports",
    "E-sports",
    "Outdoor Sports",
    "Fitness and Wellness",
    "Healthcare",
    "Medical Services",
    "Pharmaceuticals",
    "Biotechnology",
    "Genetic Engineering",
    "Nutraceuticals",
    "Mental Health",
    "Therapy",
    "Counseling",
    "Telehealth",
    "Education",
    "Online Learning",
    "E-Learning",
    "EdTech",
    "Online Courses",
    "Smart Cities",
    "Urban Planning",
    "Sustainable Urban Development",
    "Smart Transportation",
    "Clean Energy Solutions",
    "Digital Transformation",
    "Tech Startups",
    "Business Innovation",
    "Management Consulting",
    "Legal Services",
    "Regulatory Compliance",
    "Tax Consulting",
    "Market Research",
    "Product Development",
    "Quality Assurance"
];

let tags = products.concat(otherTags);


function initFakeCompany() {
    let company_name = $('#first_name').val();
    let company_website = $('#website').val();
    let company_type = $('#type').val();
    let company_start = $('#company_start').val();
    let company_overview = $('#overview').val();
    let company_contact = $('#contact').val();
    let company_email = $('#email').val();
    let company_address1 = $('#address1').val();
    let company_address2 = $('#address2').val();
    let company_postal = $('#postal').val();
    let company_city = $('#city').val();
    let company_state = $('#state').val();
    let company_country = $('#country').val();
    let company_revenue = $('#revenue').val();
    let company_operating_profit = $('#operating_profit').val();
    let company_net_profit = $('#net_profit').val();
    let company_total_assets = $('#total_assets').val();
    let company_current_market_capital = $('#current_market_capital').val();
    let company_capital = $('#capital').val();
    let company_sector_primary = $('#class_sector_primary').val();
    let company_sector_secondary = $('#class_sector_secondary').val();

    if (company_name === '') {
        $('#first_name').val('John Metal Trading Pte Ltd');
    }
    if (company_website === '') {
        $('#website').val('https://johnmetaltrading.com');
    }
    if (company_type === '') {
        $('#type').val('2').trigger('change');
    }
    if (company_start === '') {
        $('#company_start').val('2005');
    }
    if (company_overview === '') {
        $('#overview').val(`John Metal Trading Pte Ltd is a dynamic and innovative metal trading company based in Singapore. With over two decades of experience in the industry, we have established ourselves as a trusted partner for businesses seeking top-quality metal products and exceptional customer service. Our mission is to provide our clients with the highest quality metal products, exceptional service, and competitive pricing. We are committed to forging long-lasting partnerships with our customers, suppliers, and stakeholders.`);
    }
    if (company_contact === '') {
        $('#contact').val('+601115005509');
    }
    if (company_email === '') {
        $('#email').val('https://johnmetaltrading.com');
    }
    if (company_address1 === '') {
        $('#address1').val('123 Main St');
    }
    if (company_address2 === '') {
        $('#address2').val('Apt 123');
    }
    if (company_postal === '') {
        $('#postal').val('10001');
    }
    if (company_city === '') {
        $('#city').val('New York');
    }
    if (company_state === '') {
        $('#state').val('NY');
    }
    if (company_country === '') {
        $('#country').val('United States');
    }
    if (company_revenue === '') {
        $('#revenue').val('1');
    }
    if (company_operating_profit === '') {
        $('#operating_profit').val('3');
    }
    if (company_net_profit === '') {
        $('#net_profit').val('4');
    }
    if (company_total_assets === '') {
        $('#total_assets').val('5');
    }
    if (company_current_market_capital === '') {
        $('#current_market_capital').val('23');
    }
    if (company_capital === '') {
        $('#capital').val('11');
    }
    if (company_sector_primary === '') {
        $('#class_sector_primary').val('10').trigger('change');
    }
    if (company_sector_secondary === '') {
        $('#class_sector_secondary').val('15').trigger('change');
    }
}
