// Bom padrão para implementar novas funcionalidades em um hierarquia de classes já criada. 
// É um pouco intrusivo, por ter que alterar cada classe na hierarquia, 
// porém como isso é feito uma única vez vale a pena, 
// já que qualquer outra funcionalidade pode ser adicionada a hierarquia de classes a partir disso

using System;
using System.Text;

namespace Coding.Exercise
{
  public abstract class ExpressionVisitor
  {
    public abstract void Visit(Value v);
    public abstract void Visit(AdditionExpression ae);
    public abstract void Visit(MultiplicationExpression me);
  }

  public abstract class Expression
  {
    public abstract void Accept(ExpressionVisitor ev);
  }

  public class Value : Expression
  {
    public readonly int TheValue;

    public Value(int value)
    {
      TheValue = value;
    }

        public override void Accept(ExpressionVisitor ev)
        {
            ev.Visit(this);
        }

        // todo
    }

  public class AdditionExpression : Expression
  {
    public readonly Expression LeftExpression, RightExpression;

    public AdditionExpression(Expression lhs, Expression rhs)
    {
      LeftExpression = lhs;
      RightExpression = rhs;
    }

        public override void Accept(ExpressionVisitor ev)
        {
            ev.Visit(this);
        }

        // todo
    }

  public class MultiplicationExpression : Expression
  {
    public readonly Expression LeftExpression, RightExpression;

    public MultiplicationExpression(Expression lhs, Expression rhs)
    {
      LeftExpression = lhs;
      RightExpression = rhs;
    }

        public override void Accept(ExpressionVisitor ev)
        {
            ev.Visit(this);
        }

        // todo
    }

  public class ExpressionPrinter : ExpressionVisitor
  {
      private StringBuilder sb = new StringBuilder();
    public override void Visit(Value value)
    {
      sb.Append(value.TheValue);
    }

    public override void Visit(AdditionExpression ae)
    {
      sb.Append("(");
      ae.LeftExpression.Accept(this);
      sb.Append("+");
      ae.RightExpression.Accept(this);
      sb.Append(")");
    }

    public override void Visit(MultiplicationExpression me)
    {
      me.LeftExpression.Accept(this);
      sb.Append("*");
      me.RightExpression.Accept(this);
    }

    public override string ToString()
    {
      return sb.ToString();
    }

    }
}
