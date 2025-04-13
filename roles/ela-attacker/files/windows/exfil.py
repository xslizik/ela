from flask import Flask, request

app = Flask(__name__)

@app.route('/upload', methods=['POST'])
def upload_file():
    file = request.files['file']
    file.save(file.filename)
    return 'File uploaded!\n'

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80)