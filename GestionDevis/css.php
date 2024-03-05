<style>
/* Color palette */
:root {
    --primary-color:    #2F2D92; /* Primary color */
    --secondary-color:  #E36C14; /* Secondary color */
    --background-color: #EEEEEE; /* Background color */
}

/* Reset styles */
body, h1, h2, p {
    margin: 0;
    padding: 0;
}

/* General styles */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: var(--background-color); /* Use background color */
    color: #333; /* Default text color */
}
.page-title {
    color: var(--primary-color); /* Use secondary color */
    font-weight: bold;
    font-size: 60px; /* Adjust the font size as needed */
    text-align: center;
    width: 100%;
  }
/* Header styles */
.top{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: var(--background-color); /* Use background color */
    color: black;
    width: 100%;
    z-index: 100;
}

.header img {
    height: 300px;
}

.login-link {
    color:var(--secondary-color); 
    text-decoration: none;
}

/* Container styles */
.container {
    display: flex;
    min-height: 100vh;
    padding-top: 60px;
}

/* Left menu styles */
.left-menu {
    background-color: var(--background-color); /* Use background color */
    width: 250px;
    float: left;
    padding: 20px;
}

.menu-item {
    margin-bottom: 10px;
    cursor: pointer;
    padding: 10px;
    background-color: var(--background-color); /* Use background color */
}

/*.menu-item:hover {
    background-color: var(--secondary-color); /* Use secondary color */
    color: white;
}

/* Main content styles */
.main-content {
    margin-left: 250px;
    padding: 20px;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: var(--primary-color); /* Use primary color */
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f5f5f5;
}

/* Footer styles */
.footer {
    background-color: var(--primary-color); /* Use primary color */
    color: white;
    padding: 30px;
    text-align: center;
}

/* Custom styles for left menu items */
.menu-item ul {
    list-style: none; /* Remove bullets */
    padding-left: 0;
}

.menu-item ul li {
    list-style: none; /* Remove bullets */
    padding-left: 0;
}

.menu-item a {
    text-decoration: none;
    color: var(--secondary-color); /* Use secondary color */
    font-weight: bold; /* Bold text */
}

.menu-item a:hover {
    color: white;
}

.menu-item .status-counts {
    color: var(--secondary-color); /* Use secondary color */
    font-weight: bold; /* Bold text */
}
</style>

