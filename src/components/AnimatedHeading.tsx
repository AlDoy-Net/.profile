import { useEffect, useState } from 'react';

interface AnimatedHeadingProps {
  text: string;
  className?: string;
  style?: React.CSSProperties;
}

const INITIAL_DELAY = 200;
const CHAR_DELAY = 30;
const CHAR_DURATION = 500;
const NBSP = ' ';

export default function AnimatedHeading({
  text,
  className = '',
  style,
}: AnimatedHeadingProps) {
  const [animated, setAnimated] = useState(false);
  const lines = text.split('\n');

  useEffect(() => {
    const timer = setTimeout(() => setAnimated(true), INITIAL_DELAY);
    return () => clearTimeout(timer);
  }, []);

  return (
    <h1 className={className} style={style}>
      {lines.map((line, lineIndex) => (
        <span key={lineIndex} className="block">
          {line.split('').map((char, charIndex) => (
            <span
              key={charIndex}
              className="inline-block transition-all ease-out"
              style={{
                opacity: animated ? 1 : 0,
                transform: animated ? 'translateX(0)' : 'translateX(-18px)',
                transitionDuration: `${CHAR_DURATION}ms`,
                transitionDelay: `${
                  lineIndex * line.length * CHAR_DELAY + charIndex * CHAR_DELAY
                }ms`,
              }}
            >
              {char === ' ' ? NBSP : char}
            </span>
          ))}
        </span>
      ))}
    </h1>
  );
}
