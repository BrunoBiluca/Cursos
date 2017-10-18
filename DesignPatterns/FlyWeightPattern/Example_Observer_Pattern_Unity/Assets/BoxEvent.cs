using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public abstract class BoxEvent {
    public abstract float GetJumpForce();
}

public sealed class JumpLittle : BoxEvent {
    public override float GetJumpForce() {
        return 30.0f;
    }
}

public sealed class JumpMiddle : BoxEvent {
    public override float GetJumpForce() {
        return 45.0f;
    }
}

public sealed class JumpHigh : BoxEvent {
    public override float GetJumpForce() {
        return 60.0f;
    }
}
