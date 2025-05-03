export const formatCurrency = (value: number): string => {
  if(!value)return '0';
  return value.toLocaleString('en-US', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });
};
