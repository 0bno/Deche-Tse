from keras.models import load_model
from keras.applications import imagenet_utils
from keras.utils.image_utils import img_to_array
from sklearn.preprocessing import LabelEncoder
import numpy as np
from PIL import Image
import os
import sys

#Read argument
argument = sys.argv[1]

# Load modelS
model = load_model('model_5class_resnet_87%.h5')
print(model)

labels = ['G&M', 'Organic', 'Other', 'Paper', 'Plastic']
le = LabelEncoder()
labels = le.fit_transform(labels)

# Disable stantard output
def blockPrint():
    sys.stdout = open(os.devnull, 'w')

# Restore standard output
def enablePrint():
    sys.stdout = sys.__stdout__

#Transformation on input image
def pre(img_path):
    img = img_path.resize((224, 224))   
    img = img_to_array(img)
    img = imagenet_utils.preprocess_input(img)
    img = np.expand_dims(img / 255, 0)
    return img

#Get type of trash
def getTrashType():
    img =  Image.open(argument)
    img1 = pre(img)
    blockPrint()
    p = model.predict(img1)
    confidences = max(np.squeeze(model.predict(img1)))
    conf = round(confidences, 3)
    predicted_class = le.classes_[np.argmax(p[0], axis=-1)]
    enablePrint()
    return predicted_class

#delete image after use
typeOfTrash = getTrashType()
print(typeOfTrash)    



