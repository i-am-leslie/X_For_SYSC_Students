"""
Unit testing A01
- Install selenium (for unit testing webpages)
pip install selenium
pip3 install selenium


- Install mysql.connector (for unit testing mysql commands)
pip install mysql-connector-python
pip3 install mysql-connector-python

- Copy the file "A01_unit_testing.py to your assignment's project folder:
    
- If you don't have Firefox, search for this line and change it from 
        driver = webdriver.Firefox()
- to this for Chrome browser
        driver = webdriver.Chrome()
                
Run the code and your grade will be shown in the terminal.

Author: Dr. Rami Sabouni, Systems and Computer Engineering, Carleton University
Version 2.3: 8:50PM February 17, 2024
Edit: Fixed bug that was not displaying which tests had failed.
"""

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
import os
import time

# fill register form


def fill_field_register(field_details: list[str]):
    """Fill the register.php page with values from field_details

    Args:
        field_details (list[str]): List of values to be filled in the register form.

    Returns:
        None
    """
    element = driver.find_element(By.TAG_NAME, "select")
    element.send_keys(field_details[4])
    element = driver.find_elements(By.TAG_NAME, "input")
    i = 0
    for e in element:
        if e.get_attribute("type") != "submit":
            e.clear()
            e.send_keys(field_details[i])
        elif e.get_attribute("type") == "submit":
            e.send_keys(Keys.RETURN)
            return
        i += 1

# fill profile form


def fill_field_profile(field_details: list[str]):
    """Fill the profile.php page with values from field_details

    Args:
        field_details (list[str]): List of values to be filled in the profile form.

    Returns:
        None
    """
    elements = driver.find_elements(By.TAG_NAME, "input")
    i = 0
    element = driver.find_element(By.TAG_NAME, "select")
    element.send_keys(field_details[9])
    for e in elements:

        if e.get_attribute("type") != "submit" and e.get_attribute("type") != "radio" and e.get_attribute("type") != "hidden":
            e.clear()
            e.send_keys(field_details[i])
        elif e.get_attribute("type") == "radio" and i == 11:
            e.click()
        elif e.get_attribute("type") == "submit":
            driver.implicitly_wait(5)
            e.send_keys(Keys.RETURN)
            return
        i += 1

# fill index form


def fill_field_index(field_details: tuple[str, str]):
    """Fill the index.php page with values from field_details

    Args:
        field_details (tuple[str, str]): Tuple containing the field name
        and value to be filled in the index form.

    Returns:
        None
    """
    element = driver.find_element("name", field_details[0])
    element.clear()
    element.send_keys(field_details[1])


def get_result() -> list[str]:
    """Return the results retrieved from the posts in the index.php page

    Returns:
        list[str]: List of results retrieved from the posts.
    """
    elements = driver.find_elements(By.TAG_NAME, "p")
    result = []
    for element in elements:
        result += [element.get_attribute("innerHTML")]
    return result


def unit_test(actual: str, expected: str) -> str:
    """Test if the actual value matches the expected value

    Args:
        actual (str): The actual value to be tested.
        expected (str): The expected value.

    Returns:
        str: "Pass" if the values match, "Fail" otherwise.
    """
    global num_pass, num_fail

    if actual == expected:
        num_pass += 1
        return "Pass"
    else:
        num_fail += 1
        return "Fail"


def partial(lst: list[str], query: str):
    """Return the string that contains the partial string query

    Args:
        lst (list[str]): List of strings to search in.
        query (str): The partial string to search for.

    Returns:
        list[str]: List of strings containing the partial string.
    """
    return [s for s in lst if query in s]


# mian code
if __name__ == "__main__":
    print("\n" + "*" * 10 + "\n")
    # to get the current working directory
    directory = "file://" + os.getcwd() + "/"

    # HTML files to be tested
    file_names = ["index.html", "profile.html", "register.html"]

    # read the names of the .php files
    grade = 0

    for file in file_names:
        if "register.html" in file:
            # Testing register.html
            try:
                # open page in a browser
                driver = webdriver.Chrome()  # change this to Chrome if you don't have Firefox

                driver.get(directory + file)
                driver.implicitly_wait(10)
                register_fields = {"first_name": "John", "last_name": "Snow", "DOB": "001010-10-10",
                                   "student_email": "johnsnow@mail.com", "program": "Computer Systems Engineering"}

                # Fill the form
                fill_field_register(list(register_fields.values()))

                # Test if the filled form worked
                print("Score for {0}: ".format(file))
                num_pass = 0
                num_fail = 0

                content_start = ["<strong>First Name: </strong>", "<strong>Last Name: </strong>",
                                 "<strong>Date of Birth: </strong>", "<strong>Student Email: </strong>",
                                 "<strong>Program: </strong>"]

                i = 0
                time.sleep(2)
                results = get_result()
                for item in register_fields.items():
                    test = partial(results, content_start[i] + item[1])
                    if item[0] == "DOB":
                        print("testing field {0}: {1}".format(item[0], unit_test(
                            partial(results, content_start[i] + item[1][2::])[0], content_start[i] + item[1][2::])))
                    elif test:
                        print("testing field {0}: {1}".format(item[0], unit_test(
                            partial(results, content_start[i] + item[1])[0], content_start[i] + item[1])))
                    else:
                        print("testing field {0}: Fail".format(item[0]))
                        num_fail += 1
                    i += 1

                print("In register.html:\n\t Number of tests {0}: {1} passed and {2} failed.".format(
                    num_pass+num_fail, num_pass, num_fail))
            except:
                print("Fail: ", file)

            # Results this test
            print("\nRegister results: {0} / 100\n".format((num_pass/5) * 100))
            grade += (num_pass/5) / 3
            driver.close()

        elif "profile.html" in file:
            num_pass=1
            # Testing profile.html
            try:
                # open page in a browser
                driver = webdriver.Chrome()  # change this to Chrome if you don't have Firefox

                driver.get(directory + file)
                profile_fields = {"first_name": "john", "last_name": "snow", "DOB": "001011-10-10", "street_number": "1234", "street_name": "colonel", "city": "The North",
                                  "province": "ON", "postal_code": "k1s5b6", "student_email": "john.snow@mail.com", "program": "Electrical Engineering", "avatar": "2"}

                # Fill the form
                fill_field_profile(list(profile_fields.values()))

                # Test if the filled form worked
                print("Score for {0}: ".format(file))
                num_pass = 0
                num_fail = 0

                content_start = ["<strong>First Name: </strong>", "<strong>Last Name: </strong>",
                                 "<strong>Date of Birth: </strong>", "<strong>Street Number: </strong>",
                                 "<strong>Street Name: </strong>", "<strong>City: </strong>",
                                 "<strong>Province: </strong>", "<strong>Postal Code: </strong>",
                                 "<strong>Student Email: </strong>", "<strong>Program: </strong>",
                                 "<strong>Avatar: </strong>"]
                i = 0

                time.sleep(2)
                results = get_result()
                for item in profile_fields.items():
                    test = partial(results, content_start[i] + item[1])
                    if item[0] == "DOB":
                        print("testing field {0}: {1}".format(item[0], unit_test(
                            partial(results, content_start[i] + item[1][2::])[0], content_start[i] + item[1][2::])))
                    elif test:
                        print("testing field {0}: {1}".format(item[0], unit_test(
                            partial(results, content_start[i] + item[1])[0], content_start[i] + item[1])))
                    else:
                        print("testing field {0}: Fail".format(item[0]))
                        num_fail += 1
                    i += 1

                print("In profile.html:\n\t Number of tests {0}: {1} passed and {2} failed.".format(
                    num_pass+num_fail, num_pass, num_fail))
            except:
                print("Fail: ", file)

            # Results this test
            print("\nProfile results: {0} / 100\n".format((num_pass/11) * 100))
            grade += (num_pass/11) / 3
            driver.close()

        elif "index.html" in file:
            # Testing index.html
            try:
                driver = webdriver.Chrome()  # change this to Chrome if you don't have Firefox

                print(directory + file)
                driver.get(directory + file)
                index_fields = {"new_post1": "This is post 1"}

                # Fill the form
                for item in index_fields.items():
                    post = (item[0][:8], item[1])
                    fill_field_index(post)
                    submit = driver.find_element(By.TAG_NAME, "input")
                    submit.click()

                # Test if the filled form worked
                print("Score for {0}: ".format(file))
                num_pass = 0
                num_fail = 0

                results = get_result()
                content_start = "<strong>The new post is: </strong>"
                for item in index_fields.items():
                    test = partial(results, content_start + item[1])
                    if test:
                        print("testing field {0}: {1}".format(item[0], unit_test(
                            partial(results, content_start + item[1])[0], content_start + item[1])))
                    else:
                        print("testing field {0}: Fail".format(item[0]))
                        num_fail += 1
                print("In index.php:\n\t Number of tests {0}: {1} passed and {2} failed.".format(
                    num_pass+num_fail, num_pass, num_fail))
            except:
                print("Fail: ", file)

            # Results this test
            print("\nIndex results: {0} / 100\n".format((num_pass * 100)))
            grade += num_pass / 3
            driver.close()

    # Final Assignment Results
    print("Final A01 score is: {0} / 100". format(grade * 100))
