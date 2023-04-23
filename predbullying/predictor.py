# -*- coding: utf-8 -*-

# Install python dependencies
#!pip install google-play-scraper
#!pip install wordcloud
#!pip install seaborn
#!pip install matplotlib
#!pip install scikit-learn

# print('The scikit-learn version is {}.'.format(sklearn.__version__))
# print('The scikit-learn version is {}.'.format(sklearn.__version__))
# scikit-learn version is 1.0.2.

# Command line:
# python predictor.py com.shopee.id 10 1 0.85

##########################################################
# 1. IMPORT ALL PACKAGES
##########################################################
from youtube_comment_downloader import *
from itertools import islice
import sys
from wordcloud import WordCloud, STOPWORDS, ImageColorGenerator
import matplotlib.pyplot as plt
from nltk.corpus import stopwords
import pandas as pd
from collections import Counter
import seaborn as sns
from sklearn.linear_model import Perceptron
import sklearn
import joblib
import numpy as np
import pickle
import string
import re
import nltk
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.feature_extraction.text import TfidfVectorizer
nltk.download("stopwords")  # Filtering (Stopword Removal)

# Function to Download Youtube


def get_youtube_comments(urlYtb, intCount):
    downloader = YoutubeCommentDownloader()
    comments = downloader.get_comments_from_url(
        urlYtb, sort_by=SORT_BY_POPULAR)

    # for comment in islice(comments, 10):
    #    print(comment)

    df = pd.DataFrame(comments)
    df = df.iloc[1:intCount]
    # df.to_csv()

    return df

# Function to save and display wordcloud


def save_display_wordcloud(df_input, save_path, target_class):
    txt_review = " ".join(
        review for review in df_input.loc[df_input['pred_class'] == target_class].text)

    if not txt_review:  # check if string empty
        txt_review = 'null'

    # create the wordcloud object
    wordcloud = WordCloud(background_color='white',
                          collocations=False).generate(txt_review)
    plt.imshow(wordcloud, interpolation='bilinear')  # show wordcloud
    plt.axis("on")  # view garis coordinate
    plt.savefig(save_path)  # save file image
    plt.close()  # Save Plot Without Displaying
    # plt.show()


# Function to remove punctuations


def remove_punctuations(text):
    for sym_punc in string.punctuation:
        text = text.replace(sym_punc, ' ')
        # replace multiple spaces with single space
        text = re.sub(' +', ' ', text)
    return text

# Function to remove duplicate characters


def remove_duplicate_chars(text):
    pattern = r'(.)\1+'  # (.) any character repeated (\+) more than
    repl = r'\1'        # replace it once
    text = re.sub(pattern, repl, text)
    return text

# Function to load filter to list (berisi kata-kata yang akan di filter)


def load_indonesia_filter():
    # get stop words
    filtering = stopwords.words("indonesian")
    # append additional stopword
    filtering.extend(["yg", "untuk", "dg", "rt", "dgn", "ny", "d", 'klo', 'deh', 'sekarang', 'ku', 'jam', 'rumah', 'kan', 'nya', 'member', 'alfa', 'gift', "aplikasi",
                      'kalo', 'amp', 'biar', 'bikin', 'bilang', 'tokonya', 'toko', 'bnget', 'ini', "dulu", "kalau", "jadi", "sekarang", "kerja", "pulang", "pada", "sedang", "download", "langsung", "ingin", "tertawa",
                      "nomor", "lihat", "aplikasi", "sebagai", "saya", "voucher", "malah", "yah", "alfagift", 'untuk', 'ga', 'krn', 'nya', 'nih', 'sih', 'emg', 'kk',
                      'si', 'tau', 'tdk', 'tuh', 'utk', 'yaaa', 'ya', 'nomor', 'aktif', 'titik', 'jd', 'jgn', 'sdh', 'aja', 'ka', 't', 'user', 'versi', 'nyg', 'hehe', 'yaa', 'lihat', 'nan', 'loh', 'rs', 'telepon', 'x',
                      '&amp', 'yah', 'covid', 'dirawat', 'aplikasi', 'apk', 'aplikasinya', 'sehari', 'kasir', "ponta", "saat", "atau", "anak", "pencet", "login", "di", "hp", "masa", "nomor", "trus", "nya", "masa", "struk",
                      "qt", "bayar", "kan", "keranjang", "checkout", "dr", "sistem", "alfagift", "aplikasi", "alfa", "kaya", "baru", "apk", "down", "hbs", "jam", "saat", "di", "app",
                      "nya", "ke", "sih", "alfa", "youtube", "nafsu", "belanja", "kali", "barang", 'ambil', 'pas', 'dateng', 'kurir', 'outlet', 'vmg', 'bekasi', 'utara', 'dah', 'scan', 'tapi', 'butuh', 'besok', 'sat', 'memesan',
                      'pake', 'belanjan', 'keranjang', 'edit', 'pokok', 'mending', 'memory', 'recipt', 'dihapus', 'sya', 'blanja', 'dpt', 'points', "point", 'kebijakanya', 'pelangan', 'dimana', 'foucher', 'cashback', 'klaim', 'sedah',
                      'alfamart', 'faktur', 'dint', 'nt', 'daftar', 'nyampe', 'tu', 'ada', 'beli', 'es', 'krim', 'carikan', 'leleh', 'kupon', 'min', 'order', 'memenuhi', 'syarat', 'eh', 'produk', 'produknya', 'kaya', 'pengiriman', 'list', 'brp', 'alamat',
                      'yg', 'transaksi', 'deh', 'respon', 'nya', 'checkout', 'pelayanan', 'pelayanannya'])
    filtering.remove("padahal")
    return filtering


if __name__ == '__main__':
    # input parameter for downloading data
    urlYtb = ""+str(sys.argv[1])
    countSize = int(sys.argv[2])  # total sample

    # download data
    ori_data = get_youtube_comments(urlYtb, countSize)
    data = ori_data.copy()  # copy DataFrame

    # view 10 rows
#    data.head(10)

    print(ori_data.iloc[1].tolist())

    # Data preprocessing
    data['text'] = data['text'].str.replace(
        '\d+', '', regex=True)  # Remove numbers from string
    # Change Strings to lowercase
    data['text'] = data['text'].str.lower()
    # Remove punctuations (Annotation Removal)
    data["text"] = data['text'].apply(remove_punctuations)
    data["text"] = data['text'].apply(
        remove_duplicate_chars)  # Remove repeated characters
    data['text'] = data['text'].apply(lambda x: x.encode(
        'ascii', 'ignore').decode('ascii'))  # Remove emojis

    # load filter words
    filter_words = load_indonesia_filter()

    # remove stop words (filtering)
    data['text'] = data['text'].apply(lambda words: ' '.join(
        word.lower() for word in words.split() if word not in filter_words))
    data = data.dropna(subset=['text'])  # Remove Missing Values


##########################################################
# 4. FEATURE EXTRACTION TECHNIQUES
##########################################################
# load object vectorizer (vocabulary)
vectorizer = joblib.load("./model/vectorizer_bull.pkl")

# Printing the identified Unique words along with their indices
# print("Vocabulary: ", vectorizer.vocabulary_)

# Add column for class/label ("positive = 0", "Negative = 1", "Neutral = 2")
# Generate feature [input data] from dictionary
test_data = vectorizer.transform(data['text']).toarray()
x_test = pd.DataFrame(
    data=test_data, columns=vectorizer.get_feature_names_out())
# x_test.to_csv('/content/drive/MyDrive/test_data.csv', encoding='utf-8', index=False)

# x_test

##########################################################
# 7. LOAD MODEL Perceptron Algorithms
##########################################################
# save the model to disk
filename = './model/predcyberbullying.model'

# load the model from disk
loaded_model = pickle.load(open(filename, 'rb'))

pred_proba = loaded_model.predict_proba(x_test)

# Create columns for each sentiment prediction
class_nonbull = []
class_bull = []
label_pred_namual = []

for score in pred_proba:
    class_nonbull.append(str(round((score[0]*100), 2))+"%")
    class_bull.append(str(round((score[1]*100), 2))+"%")

    if score[1] > 0.75:  # >= 0.85
        label_pred_namual.append("Bull")
    else:
        label_pred_namual.append("Non-Bull")

data["pred_class"] = label_pred_namual
ori_data["pred_class"] = label_pred_namual
ori_data["pred_nonbull"] = class_nonbull
ori_data["pred_bull"] = class_bull

# replace prediction class to a label name
data["pred_class"] = data["pred_class"].replace(
    [0.0, 1.0], ['Non-Bull', 'Bull'])
ori_data["pred_class"] = ori_data["pred_class"].replace(
    [0.0, 1.0], ['Non-Bull', 'Bull'])

# Data distribution for each class
dst_train = Counter(ori_data['pred_class'])
print(dst_train)

# declare data
if dst_train.get('Non-Bull') == None:
    data_values = [0, dst_train.get('Bull')]
    key_class_name = ['Content Good \n (0) Non-Bull Com',
                      'Content Not Good \n ('+str(data_values[1])+') Bull Com']
elif dst_train.get('Bull') == None:
    data_values = [dst_train.get('Non-Bull'), 0]
    key_class_name = ['Content Good \n ('+str(data_values[0])+') Non-Bull Com',
                      'Content Not Good \n (0) Bull Com']
else:
    data_values = [dst_train.get('Non-Bull'), dst_train.get('Bull')]
    key_class_name = ['Content Good \n ('+str(data_values[0])+') Non-Bull Com',
                      'Content Not Good \n ('+str(data_values[1])+') Bull Com']


# declaring exploding pie
explode = [0.1, 0]
# define Seaborn color palette to use
palette_color = sns.color_palette('bright')
# palette_color = sns.color_palette('dark')
# plotting data on chart
plt.pie(data_values, labels=key_class_name, explode=explode,
        colors=palette_color, autopct='%.0f%%')
plt.savefig('./image/pie.png')
plt.close()  # Save Plot Without Displaying
# plt.show()  # displaying chart

# Call function and save positive sentiment
img_path = "./image/pos_sentiment.png"
# Positive sentiment = "Pos" dan Negative sentiment = "Neg".
input_target_class = "Non-Bull"
save_display_wordcloud(data, img_path, input_target_class)

# Call function and save positive sentiment
img_path = "./image/neg_sentiment.png"
# Positive sentiment = "Pos" dan Negative sentiment = "Neg".
input_target_class = "Bull"
save_display_wordcloud(data, img_path, input_target_class)

# save output pandas dataframe
ori_data.to_csv('./data/output_final_data.csv', encoding='utf-8', index=False)

print("success !!!")
