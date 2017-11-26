# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db    import models
from django.utils import timezone

class Room(models.Model):
    code = models.CharField(max_length=4)

    def __str__(self):
        return self.code

class Question(models.Model):
    room          = models.ForeignKey(Room, on_delete=models.CASCADE)
    tag           = models.CharField(max_length=20)
    question_text = models.CharField(max_length=200, default="")
    timestamp     = models.DateTimeField('date posted', default=timezone.now)

    def __str__(self):
        return "From: " +self.room +" text: " + self.question_text
