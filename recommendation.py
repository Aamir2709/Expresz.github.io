import numpy as np
import pandas as pd
import matplotlib.pyplot as plt

# %matplotlib inline
plt.style.use("ggplot")

import sklearn
from sklearn.decomposition import TruncatedSVD
#Content based filtering
expresz_ratings = pd.read_csv('ratings.csv')
expresz_ratings = expresz_ratings.dropna()
expresz_ratings.head()

expresz_ratings.shape

popular_products = pd.DataFrame(expresz_ratings.groupby('product_id')['rating'].count())
most_popular = popular_products.sort_values('rating', ascending=False)
most_popular.head(10)

most_popular.head(30).plot(kind = "bar")

#Collaborative Filterings
expresz_ratings1 = expresz_ratings.head(10000)

ratings_utility_matrix = expresz_ratings1.pivot_table(values='rating', index='user_id', columns='product_id', fill_value=0)
ratings_utility_matrix.head()

ratings_utility_matrix.shape

X = ratings_utility_matrix.T
X.head()

X.shape

X1=X

SVD = TruncatedSVD(n_components=10)
decomposed_matrix = SVD.fit_transform(X)
decomposed_matrix.shape

correlation_matrix = np.corrcoef(decomposed_matrix)
correlation_matrix.shape

X.index[4]

i = 4

product_names = list(X.index)
product_ID = product_names.index(i)


correlation_product_ID = correlation_matrix[product_ID]
correlation_product_ID.shape
#print(correlation_product_ID)

Recommend = list(X.index[correlation_product_ID > 0.90])

# Removes the item already bought by the customer
Recommend.remove(i) 

print(Recommend)