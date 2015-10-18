#!/bin/bash

export DISPLAY=:0
XAUTHORITY=/home/pi/.Xauthority

MYWINDOW=$(xdotool getactivewindow)
xdotool windowfocus --sync ${MYWINDOW}
xdotool windowactivate --sync ${MYWINDOW}
xdotool key --clearmodifiers "SHIFT+CTRL+R" ${MYWINDOW}


