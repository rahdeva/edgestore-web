import email
from django.db import models
# create models
from django.contrib.auth.models import AbstractUser

class CustomUser(AbstractUser):
    EMAIL_FIELD='email'
    USERNAME_FIELD='email'
    REQUIRED_FIELDS=['username']
    username=models.CharField(blank=True,max_length=24)
    email=models.EmailField(blank=True,max_length=24,unique=True,verbose_name="email_address")

#    