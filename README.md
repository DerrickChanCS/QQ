# QQ

## Setup
1. Mount the folder that you want the project to be saved too e.g. `cd ~/Documents`
2. Clone the repository using `git clone https://github.com/DerrickChanCS/QQ.git`. This will create a folder called QQ.
3. Create your virtual environment. This step is not strictly neccessary but it will help keep your main python executable clean.
   - `pip install --user virtaulenv`
   - `pip install --user virtualenvwrapper`
   - `PATH="$PATH:/usr/bin/"`
   - ``` source `which virtualenvwrapper.sh` ```
   - `mkvirtualenv 174Django`
4. Swap to the virtualenv `workon 174Django`
5. Install django `pip install django`
6. Mount the git repository e.g. `cd ~/Documents/QQ`
7. Start the app server `python manage.py runserver`
