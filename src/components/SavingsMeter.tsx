import React from 'react';
import { View, Text, StyleSheet } from 'react-native';
import Svg, { Path, G } from 'react-native-svg';

function polarToCartesian(centerX: number, centerY: number, radius: number, angleInDegrees: number) {
  let angleInRadians = (angleInDegrees-90) * Math.PI / 180.0;
  return {
    x: centerX + (radius * Math.cos(angleInRadians)),
    y: centerY + (radius * Math.sin(angleInRadians))
  };
}


function describeArc(x: number, y: number, radius: number, startAngle: number, endAngle: number) {
  let start = polarToCartesian(x, y, radius, endAngle);
  let end = polarToCartesian(x, y, radius, startAngle);

  let largeArcFlag = endAngle - startAngle <= 180 ? "0" : "1";

  let d = [
    "M", start.x, start.y,
    "A", radius, radius, 0, largeArcFlag, 0, end.x, end.y
  ].join(" ");

  return d;
}

// @ts-ignore
export function SavingsMeter({ value, goal }) {

  const size = 250;
  const strokeWidth = 34;
  const radius = (size - strokeWidth) / 2;
  const center = size / 2;
  const startAngle = 135;
  const endAngle = 405;


  const percent = Math.min(value / goal, 1);
  const progressEndAngle = startAngle + (endAngle-startAngle) * percent;

  return (
    <View style={styles.container}>
      <Svg width={size} height={size}>
        <G rotation="90" origin={`${center}, ${center}`}>
          <Path
            d={describeArc(center, center, radius, startAngle, endAngle)}
            stroke="#e6e6ef"
            strokeWidth={strokeWidth}
            fill="none"
            strokeLinecap="round"
          />

          <Path
            d={describeArc(center, center, radius, startAngle, progressEndAngle)}
            stroke="#ffd263"
            strokeWidth={strokeWidth}
            fill="none"
            strokeLinecap="round"
          />
        </G>
      </Svg>
      <View style={styles.textContainer}>
        <Text style={styles.amount}>{value.toFixed(2)}</Text>
      </View>
      <Text style={styles.goalLabel}>
        Saved out of <Text style={styles.goalValue}>TZS {goal}</Text> goal
      </Text>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    alignItems: "center",
    padding: 16,
    backgroundColor: "#faf8fd"
  },
  textContainer: {
    position: 'absolute',
    top: 0, left: 0, right: 0, bottom: 56,
    justifyContent: "center",
    alignItems: "center"
  },
  amount: {
    fontSize: 38,
    color: "#181347",
    fontWeight: "bold"
  },
  goalLabel: {
    marginTop: 16,
    color: '#666',
    fontSize: 18,
    textAlign: 'center'
  },
  goalValue: {
    fontWeight: 'bold',
    color: "#181347",
    fontSize: 20,
  }
});
