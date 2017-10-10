# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models

class Room(models.Model):
    code = models.CharField(max_length=4)

class Question(models.Model):
    room = models.ForeignKey(Room, on_delete=models.CASCADE)
    tag =  models.CharField(max_length=20)

